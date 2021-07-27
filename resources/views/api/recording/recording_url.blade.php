<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
	// Define default object if all links are not working
	let def_url = '{{ $urls->wav }}'

	let default_url_obj = {
					          url: def_url,
					          urlType: "wav"
				          }

	
	let p1 = new Promise((resolve, reject) => {
		let wav_url = '{{ $urls->wav }}'

		$.get('/api/recording/check-url',{url: wav_url},function(res){
			if(res.http_code == 200){
				resolve({
					url: res.url,
					type: res.type
				})
			}
		})
	})


	let p2 = new Promise((resolve, reject) => {
		let mp3_url = '{{ $urls->mp3 }}'

		$.get('/api/recording/check-url',{url: mp3_url},function(res){
			if(res.http_code == 200){
				resolve({
					url: res.url,
					type: res.type
				})
			}
		})
	})


	let p3 = new Promise((resolve, reject) => {
		let arch_url = '{{ $urls->arch }}'

		$.get('/api/recording/check-url',{url: arch_url},function(res){
			if(res.http_code == 200){
				resolve({
					url: res.url,
					type: res.type
				})
			}
		})
	})

	// Run the 3 Promises simultaneuosly. Return the first URL that loads successfully.
	// If none of the 3, return the wav version
	let success_obj = {}

	Promise.any([p1,p2,p3])
	       .then(res => {
	          // document.write(JSON.stringify(res))
	          document.querySelector('body').innerHTML = JSON.stringify(res);
	          success_obj = res
	       }).catch((err) => {
	          if(Object.keys(success_obj).length === 0)
	            document.write(JSON.stringify(default_url_obj))
	       })
	


</script>