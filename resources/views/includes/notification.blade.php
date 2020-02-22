<script src="{{asset('assets/js/core/jquery.3.2.1.min.js')}}"></script>

<script src="{{asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
<script>

  @if(Session::has('success'))
        $.notify({
       icon: 'fa fa-thumbs-up',
     title: '"{{ Session::get('success') }}"',
     message: '',
},{
	type: 'success',
	placement: {
		from: "top",
		align: "right"
	},
	time: 1000,
      });
     @php
       Session::forget('success');
     @endphp
  @endif

  @if(Session::has('info'))
      $.notify({
      icon: 'la la-bell',
	title: '{{ Session::get('info') }}',
	 message : '',

},{
	type: 'info',
	placement: {
		from: "top",
		align: "right"
	},
	time: 1000,
      });
      @php
        Session::forget('info');
      @endphp
  @endif

  @if(Session::has('warning'))
        $.notify({
    icon: 'fa fa-exclamation',
  title: '',
  message: '"{{ Session::get('warning') }}"',
},{
	type: 'warning',
	placement: {
		from: "top",
		align: "right"
	},
	time: 1000,
      });
      @php
        Session::forget('warning');
      @endphp
  @endif

  @if(Session::has('error'))
        $.notify({
    icon: 'fa fa-exclamation-triangle',
  title: '{{ Session::get('error') }}',
  message : '',
},{
	type: 'danger',
	placement: {
		from: "top",
		align: "right"
	},
	time: 1000,
      });
      @php
        Session::forget('error');
      @endphp
  @endif

</script>


