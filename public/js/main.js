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

	// supervisor search for call logs
	$(document).on('submit','.calllogs-search',function(e){
		e.preventDefault();

		var form = $(this);
		var method = form.attr('method');
		var url = form.attr('action');
		var form_data = {};
		var result_container = $('.calllogs-list');

		form.find('[name]').each(function(){
			// form_data[this.name] = this.value;
			form_data[this.name] = $(this).val();
			
		});

		$.ajax({
			url: url,
			method: method,
			data: form_data,
			success: function(response){
				result_container.empty()
								.append(response);
			}
		});
	});

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

});

	