$(document).ready(function(){


	/*
	|-------------------------------------------------------------------------
    | initialize bootstrap-select
    |-------------------------------------------------------------------------
	*/

		if($('.select-mult').length)
			$('.select-mult').selectpicker({
				actionsBox: true,
				deselectAllText: 'Deselect',
				selectAllText: 'Select'
			});

	/*
	|-------------------------------------------------------------------------
    | initialize datefield
    |-------------------------------------------------------------------------
	*/
	
	if($('.date,.datetime').length){
		// callback function
		var date = function(){
			tail.DateTime(".date",{
				dateFormat: 'mm/dd/YYYY',
				timeFormat: false
			});
		};

		var datetime = function(){
			tail.DateTime(".datetime",{
				dateFormat: 'mm/dd/YYYY',
				timeFormat: "GG:ii A",
				timeIncrement: false,
				timeStepMinutes: 1,
				timeSeconds: false
			});
		};

		// initialize date and datetime
		date();
		datetime();

		// reinitialize dynamic elements for datetime
		var elementToObserve = document.querySelector("body");
		var obsrv_date = new MutationObserver(date);
		var obsrv_datetime = new MutationObserver(datetime);
		obsrv_date.observe(elementToObserve, {subtree: true, childList: true});
		obsrv_datetime.observe(elementToObserve, {subtree: true, childList: true});
	}



	//-------------------------------------------------------------------------


	/*
	|-----------------------------------------------------------------
	| User details update
	|-----------------------------------------------------------------
	*/

	$("form.account-form").on("submit",function(e){
		var form = $(this);
		var form_data = {};
		var url = form.attr("action");
		var method = form.attr('method');
		var notif = $(".account-notif");

		e.preventDefault();

		// clean up input classes
		form.find('input').removeClass('is-invalid');

		form.find('[name]').each(function(){
			form_data[this.name] = this.value;
		});

		$.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });

	    $.ajax({
	    	url: url,
	    	method: method,
	    	data: form_data,
	    	beforeSend: function(){
	    		form.find('.btn').html("<span class='spinner-grow spinner-grow-sm'></span><span class='spinner-grow spinner-grow-sm'></span><span class='spinner-grow spinner-grow-sm'></span>");
	    	},
	    	complete: function(){
	    		form.find('.btn').text("Update");
	    	},
	    	success: function(response){
	    		if(!$.isEmptyObject(response.errors)){
                    for (var key in response.errors) {
					    if (Object.prototype.hasOwnProperty.call(response.errors, key)) {
					        $("input[name='"+ key +"']").addClass('is-invalid');
					        $("span."+ key).empty().append(response.errors[key]);
					    }
					}
                }else{
                	showAccountNotif(notif,response.success,'text-success');
                }
	    	},
	    	error: function(jqXHR,textStatus,errorThrown ){
	    		showAccountNotif(notif,jqXHR.responseJSON.fail,'text-danger');
	    	}
	    });

	});
	

	$(".acnt-tab:not(.link)").on("click",function(){
		var tab = $(this).data('tab');
		var actv_tabcontent = $('.' + tab);

		$(".actv-acnt-opt").removeClass('actv-acnt-opt');
		$(this).addClass('actv-acnt-opt');

		//.acnt-tabcontent
		$('.acnt-tabcontent').removeClass('d-none').addClass('d-none');
		actv_tabcontent.removeClass('d-none');
	});

	$(".acnt-tab.link").on("click",function(){
		var url = $(this).find('[data-url]').data('url');
		location.href = url;
	});


	$("form.password-update").on('submit',function(e){
		var form = $(this);
		var form_data = {};
		var url = form.attr("action");
		var method = form.attr('method');
		var notif = $(".password-notif"); 

		e.preventDefault();

		// clean up input classes
		form.find('input').removeClass('is-invalid');

		form.find('[name]').each(function(){
			form_data[this.name] = this.value;
		});

		$.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });

	    $.ajax({
			url: url,
			method: method,
			data: form_data,
			beforeSend: function(){
	    		form.find('.btn').html("<span class='spinner-grow spinner-grow-sm'></span><span class='spinner-grow spinner-grow-sm'></span><span class='spinner-grow spinner-grow-sm'></span>");
	    	},
	    	complete: function(){
	    		form.find('.btn').text("Update");
	    	},
			success: function(response){
				if(!$.isEmptyObject(response.errors)){
                    for (var key in response.errors) {
					    if (Object.prototype.hasOwnProperty.call(response.errors, key)) {
					        $("input[name='"+ key +"']").addClass('is-invalid');
					        $("span."+ key).empty().append(response.errors[key]);
					    }
					}
                }else{
                	showAccountNotif(notif,response.success,'text-success');
                }
			},
			error: function(jqXHR,textStatus,errorThrown ){
	    		showAccountNotif(notif,jqXHR.responseJSON.fail,'text-danger');
	    	}
		});
	});

	function showAccountNotif(el,msg,classNm){
		el.html(msg)
		  .removeClass('text-success text-danger')
		  .addClass(classNm)
		  .fadeIn(300,function(){
    		setTimeout(function(){
    			el.fadeOut(300);
    		},2000);
		  });
	}

	//-----------------------------------------------------------------------------


	$(document).on('click','.select-all',function(){
		$('.app-checkbox input').prop('checked',true);
	});
	$(document).on('click','.deselect-all',function(){
		$('.app-checkbox input').prop('checked',false);
	});

	// set a number of checkbox to be checked base on the input
	$(document).on('click','.select-custom',function(){
		var select_input = $('.input-select-custom').val();
		var rows = $('.calllogs-list').children();

		rows.each(function(idx,el){
			if(idx < select_input)
				$(el).find('.app-checkbox input').prop('checked',true);
			else
				return false;
		});

	});

	// auditor claim a single call log
	$(document).on('submit','.claim-call',function(e){
		var row_cntr = $(this).parents('tr');
		var url = $(this).attr('action');
		var method = $(this).attr('method');
		var notif = $('.cl-alert');
		var form_data = {};

		$(this).find('[name]').each(function(){
			form_data[this.name] = this.value;
		});

		e.preventDefault();

		$.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });

	    $.ajax({
	    	url: url,
	    	method: method,
	    	data: form_data,
	    	success: function(response){
	    		notif.children('strong').empty();
				notif.children('span').empty();

	    		if(!$.isEmptyObject(response.errors)){
	    			notif.children('strong').append('Error! ');
	    			notif.removeClass('alert-success alert-danger')
					     .addClass('alert-danger');

	    			for (var key in response.errors) {
					        notif.children('span').append(response.errors[key]);
					}
	    		}else{
	    			notif.children('strong').append('Success! ');
                	notif.children('span').append(response.success);
                	notif.removeClass('alert-success alert-danger')
                		 .addClass('alert-success');
	    		}
	    		
	    		row_cntr.children('td').fadeOut(700,function(){
	    			row_cntr.remove();
	    		});
	    		notif.fadeIn(300,function(){
                	setTimeout(function(){
                		notif.fadeOut(300);
                	},2000);
                });
	    	}
	    });
	});

	// auditor claim bulk call logs
	$(document).on("submit",".bulk-claim",function(e){
		e.preventDefault();

		var url = $(this).attr('action');
		var method = $(this).attr('method');
		var notif = $('.cl-alert');
		var container = $('.calllogs-list');
		var selected = container.find('input:checked');

		var calls = [];
		selected.each(function(){
			calls.push(this.value);
		});

		$.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });

		$.ajax({
			url: url,
			method: method,
			data: {
				calllogs: calls
			},
			success: function(response){
				notif.children('strong').empty();
				notif.children('span').empty();

				if(!$.isEmptyObject(response.errors)){
	    			notif.children('strong').append('Error! ');
	    			notif.removeClass('alert-success alert-danger')
					     .addClass('alert-danger');

	    			for (var key in response.errors) {
					        notif.children('span').append(response.errors[key]);
					}
	    		}else{
	    			notif.children('strong').append('Success! ');
                	notif.children('span').append(response.success);
                	notif.removeClass('alert-success alert-danger')
                		 .addClass('alert-success');
	    		}
	    		
	    		selected.parents('tr').children('td').fadeOut(700,function(){
	    			selected.parents('tr').remove();
	    		});
	    		notif.fadeIn(300,function(){
                	setTimeout(function(){
                		notif.fadeOut(300);
                	},2000);
                });
			}
		});
	});

	// auditor click on start audit button
	$(document).on('click','.start-audit',function(){
		var target_modal = $(this).data('id');

		$('.aud-modal[data-modal="'+ target_modal + '"]').fadeIn(300);
	});

	// auditor closes the modal
	$(document).on('click','.aud-modal .close',function(){
		$(this).parents('.aud-modal').fadeOut(300);
	});

	// auditor audit animation (scrolling back to top)
	$('.nav-link').on('click',function(){
		$('.tab-content').animate({ scrollTop: 0 },"slow");
	});

	$(document).on("click",".left-chevron,.right-chevron",function(){
		var tab = $(this).data('tab');

		$("a[href='#"+ tab +"']").click();
	});

	// append empty result row if no logs left
	var target_node = document.getElementById('calllogs-list');
	if($(target_node).length){
		var config = {childList: true};
		var observer = new MutationObserver(function(mutation){
			var rows = $(target_node).children().length;
			if(rows == 0){
				$(target_node).append("<tr class='text-center'><td colspan='6'>Empty results</td></tr>");
			}
		});

		observer.observe(target_node,config);
	}

	// submits the audit form
	$(document).on('submit','.audit_form',function(e){
		e.preventDefault();
		var form = $(this);
		var url = form.attr('action');
		var method = form.attr('method');
		var form_data = {};
		var content = $(this).parents('.container-fluid');

		form.find(':not(:radio)').each(function(){
			form_data[this.name] = this.value;
		});

		// handle input of type radio
		form.find(':radio:checked').each(function(){
			form_data[this.name] = this.value;
		});

		$.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });

		$.ajax({
			url: url,
			method: method,
			data: form_data,
			success: function(response){
				content.empty().append(response);
			}
		});
	});

	// auditor clicks the submit button. Trigger to submit the audit form
	$(document).on('click','.submit_audit',function(){
		var parent_container = $(this).parents('.modal-content');
		var form_to_submit = parent_container.find('.audit_form');
		form_to_submit.submit();
	});

	// supervisor search for call logs
	// $(document).on('submit','.calllogs-search',function(e){
	// 	e.preventDefault();

	// 	var form = $(this);
	// 	var method = form.attr('method');
	// 	var url = form.attr('action');
	// 	var form_data = {};
	// 	var result_container = $('.calllogs-list');

	// 	form.find('[name]').each(function(){
	// 		// form_data[this.name] = this.value;
	// 		form_data[this.name] = $(this).val();
			
	// 	});

	// 	$.ajax({
	// 		url: url,
	// 		method: method,
	// 		data: form_data,
	// 		beforeSend: function(){
	// 			$('.gray-bg').css({'display':'block'});
	// 		},
	// 		complete: function(){
	// 			$('.gray-bg').css({'display':'none'});
	// 		},
	// 		success: function(response){
	// 			result_container.empty()
	// 							.append(response);
	// 		}
	// 	});
	// });

	// supervisor assign the calllogs to team
	$(document).on('submit','.calllog-form',function(e){
		e.preventDefault();

		var form = $(this);
		var url = form.attr('action');
		var method = form.attr('method');
		var clogs = form.find('[name]:checked');
		var assigned_team = form.find('[name="assigned_team"]').val();
		var notif = $('.cl-alert');

		var calls = [];
		clogs.each(function(){
			calls.push(this.value);
		});

		$.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });

		$.ajax({
			url: url,
			method: method,
			data: {
				calllogs: calls,
				assigned_team: assigned_team
			},
			beforeSend: function(){
				$('.gray-bg').css({'display':'block'});
			},
			complete: function(){
				$('.gray-bg').css({'display':'none'});
			},
			success: function(response){
				notif.children('strong').empty();
				notif.children('span').empty();

				if(!$.isEmptyObject(response.errors)){
					notif.children('strong').append('Error! ');
					notif.removeClass('alert-success alert-danger')
					     .addClass('alert-danger');
                    for (var key in response.errors) {
					    if (Object.prototype.hasOwnProperty.call(response.errors, key)) {
					        notif.children('span').append(response.errors[key]);
					    }
					}
                }else{
                	var rows = form.find('[name]:checked').parents('tr');
                	rows.children().fadeOut(700,function(){
                		rows.remove();
                	});

                	notif.children('strong').append('Success! ');
                	notif.children('span').append(response.success);
                	notif.removeClass('alert-success alert-danger')
                		 .addClass('alert-success');
                }

                notif.fadeIn(300,function(){
                	setTimeout(function(){
                		notif.fadeOut(300);
                	},2000);
                });
			}
		});

	});

	$(document).on('click','.edit-team-trig',function(){
		var team_id = $(this).parents('tr').data('id');
		var url = '/teams/' + team_id; // look for this url using php artisan route:list

		window.location.href = url;
	});

	$(document).on('click','.add-user-team',function(){
		var url = '/user_teams'; // url should sync on the web route
		var user_id = $(this).parents('tr').data('id');
		var team_id = $(this).parents('tr').data('team');

		$.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });

	    $.ajax({
	    	url: url,
	    	method: 'post',
	    	data:{
	    		user_id: user_id,
	    		team_code: team_id
	    	},
	    	success: function(){
	    		location.reload();
				return false;
	    	}
	    });
	});

	$(document).on('click','.rem-user-team-trg',function(){
		var id = $(this).parents('tr').data('id');
		$('.rem-user-team').data('id',id);
		$('.rem-user-team-notif').fadeIn(300);
	});

	$(document).on('click','.cancel',function(){
		$(this).parents('.bg-notif').fadeOut(300);
	});

	$(document).on('click','.rem-user-team',function(){
		var id = $(this).data('id');
		var url = '/user_teams/' + id; // url should sync on the web route

		$.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });

	    $.ajax({
	    	url: url,
	    	method: 'delete',
	    	success: function(){
	    		location.reload();
				return false;
	    	}
	    });
	});


	$(document).on('click','.del-team-trg',function(){
		var id = $(this).parents('tr').data('id');
		$('.del-team').data('id',id);
		$('.del-team-notif').fadeIn(300);
	});

	
	$(document).on('click','.del-team',function(){
		var id = $(this).data('id');
		var url = '/teams/' + id; // url should sync on the web route

		$.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });

	    $.ajax({
	    	url: url,
	    	method: 'delete',
	    	success: function(){
	    		location.reload();
				return false;
	    	}
	    });
	});


	$(document).on('click','.add-team-trig',function(){
		$('.add-team-notif').fadeIn(300);
	});


	$(document).on('change','select[name=agent_dispo]',function(){
		var dispo = $(this).val();
		if(dispo == 'No'){
			$('#dispo-select').removeClass('d-none');
		}else{
			$('#dispo-select').removeClass('d-none').addClass('d-none');
		}
	});

	$(document).on('change','select[name=agnt_sys_issue]',function(){
		var issue = $(this).val();
		if(issue == 'Agent'){
			$('#agent-issue-select').removeClass('d-none');
			$('#system-issue-select').removeClass('d-none').addClass('d-none');
		}else if(issue == 'System'){
			$('#system-issue-select').removeClass('d-none');
			$('#agent-issue-select').removeClass('d-none').addClass('d-none');
		}else{
			$('#system-issue-select').removeClass('d-none').addClass('d-none');
			$('#agent-issue-select').removeClass('d-none').addClass('d-none');
		}
	});

	$(document).on('change','select[name=ztp_lol]',function(){
		var zt_lol = $(this).val();
		if(zt_lol == 'ZTP'){
			$('#zt-select').removeClass('d-none');
			$('#lol-select').removeClass('d-none').addClass('d-none');
		}else if(zt_lol == 'LOL'){
			$('#lol-select').removeClass('d-none');
			$('#zt-select').removeClass('d-none').addClass('d-none');
		}else{
			$('#zt-select').removeClass('d-none').addClass('d-none');
			$('#lol-select').removeClass('d-none').addClass('d-none');
		}
	});

	$(document).on('click','.tab',function(){
		var content = $(this).data('content');
		var mp3 = document.getElementById("audio");

		// change tab color
		$(".btn-blue.active").removeClass('active');
		$(this).removeClass('active').addClass('active');

		// change tabcontent
		$(".tabcontent.active").removeClass('active').addClass('inactive');
		$('#'+content).removeClass('inactive').addClass('active');

		// pause the audio
		mp3.pause();
	});

	$(document).on('click','.lolztp',function(){
		var user = $(this).data('user');
		var name = $(this).data('name');
		var url = 'https://docs.google.com/forms/d/e/1FAIpQLSd54spuX-aeDfHC1K5wUbkl3pQR47xQX8HHf0vWIbnY-3a4Yw/viewform?usp=pp_url&entry.1707684629=Internal+Audit&entry.1851153735='+user+'&entry.1437949203='+name;

		window.open(url);
	});

	$(document).on('click','.in_response',function(){
		var inp_container = $(this).siblings('div');

		inp_container.toggle();
		inp_container.children('input').val('');
	});

	$(document).on('submit','#audit-count-form', function(e){
		e.preventDefault();

		var form_data = $(this).serialize();
		var url = $(this).attr('action');
		var method = 'get';


		$.ajax({
			url: url,
			method: method,
			data: form_data,
			beforeSend: function(){
				var modal = `
					<div class='gray-bg d-flex' id='form-loading'>
						<div style="margin: auto;">
							<div class='spinner-grow text-info'></div>
							<div class='spinner-grow text-info'></div>
							<div class='spinner-grow text-info'></div>
						</div>
					</div>
				`;

				$('body').append(modal);
			},
			success: function(response){
				setTimeout(function(){
					$('#form-loading').remove();
					var result = $('#audit-count-cntr');
					result.html(response);
				}, 500);	
			}
		});
	});


	$(document).on('submit','.remove-mylog', function(e){
		e.preventDefault();

		var url = $(this).attr('action');
		var method = $(this).attr('method');
		var token = $(this).find('[name=_token]').val();
		var container = $(this).parents('tr');

		$.ajax({
			url: url,
			method: method,
			data: { _token: token },
			beforeSend: function(){
				var modal = `
					<div class='gray-bg d-flex' id='form-loading'>
						<div style="margin: auto;">
							<div class='spinner-grow text-info'></div>
							<div class='spinner-grow text-info'></div>
							<div class='spinner-grow text-info'></div>
						</div>
					</div>
				`;

				$('body').append(modal);
			},
			success: function(response){

				setTimeout(function(){
					$('#form-loading').remove();
					container.remove();
					var msg = response.msg;
					var alert = `
									<div class="alert alert-success alert-dismissible fade show">
										<button type="button" class="close" data-dismiss="alert">&times;</button>
										<strong>Success!</strong> ${msg}.
									</div>
								`;
					$('.center-body').prepend(alert);
				}, 500);	
			},
			error: function(response){
				setTimeout(function(){
					$('#form-loading').remove();
					container.remove();
					var msg = response.responseJSON.message;
					var alert = `
									<div class="alert alert-danger alert-dismissible fade show">
										<button type="button" class="close" data-dismiss="alert">&times;</button>
										<strong>Error!</strong> ${msg}.
									</div>
								`;

					$('.center-body').prepend(alert);
				}, 500);

			}
		});
	});


	$('#audio').on('playing',function(){
		var audit_start = $('input[name=audit_start]');

		if(audit_start.val() === ""){
			var d = get_phtime();

			var dd = String(d.getDate()).padStart(2,'0');
			var mm = String(d.getMonth() + 1).padStart(2,'0');
			var yyyy = d.getFullYear();
			var hr = String(d.getHours()).padStart(2,'0');
			var min = String(d.getMinutes()).padStart(2,'0');
			var sec = String(d.getSeconds()).padStart(2,'0');

			var full_dtime = `${yyyy}-${mm}-${dd} ${hr}:${min}:${sec}`;

			audit_start.attr('value',full_dtime);
		}

	});


	function get_phtime(){
		var d = new Date();
		var utc_offset = d.getTimezoneOffset();
		d.setMinutes(d.getMinutes() + utc_offset);

		// PH diff from UTC
		// var ph_offset = 8 * 60; // 8 hours * 60 minutes (GMT+8)
		// d.setMinutes(d.getMinutes() + ph_offset);

		// EST diff from UTC
		var est_offset = -4 * 60; // 4 hours * 60 minutes (GMT-4)
		d.setMinutes(d.getMinutes() + est_offset);

		return d;
	}


	$(document).on('submit','#hourly-form',function(e){
		e.preventDefault();

		var auditor = $(this).find('[name=auditor]').val();
		var audit_dt = $(this).find('input[name=audit_dt]').val();
		var token = $(this).find('input[name=_token]').val();
		var action = $(this).attr('action');
		var method = $(this).attr('method');

		if(audit_dt){
			$('.dt-notif').empty();
			
			$.ajax({
				url: action,
				method: method,
				data: {
					auditor: auditor,
					audit_dt: audit_dt,
					_token: token
				},
				success: function(response){
					$('#hourly-content').html(response);
				}
			});
		}else{
			$('.dt-notif').text('Date field is required');
		}
	});


	$(document).on('click','.tbl-search',function(){
		// initialize, hide existing active search area
		$('.tbl-search').parent().siblings('span').removeClass('d-none').addClass('d-none');
		$('.tbl-search').parent().parent().siblings('form').removeClass('d-none').addClass('d-none');
		$('.tbl-search').parent().parent().siblings('form').find('input').val('');


		// display the close button
		$(this).parent().siblings('span').removeClass('d-none');
		// display the form area
		$(this).parent().parent().siblings('form').removeClass('d-none');
	});


	$(document).on('click','.tbl-close',function(){
		let url = $(this).parents('table').data('baseurl');
		window.location.href = url;
	});


	$(document).on('submit','.ops-audit-remove',function(e){
		e.preventDefault();

		if(confirm("Are you sure?")){
			this.submit();
		}

	});

});

	