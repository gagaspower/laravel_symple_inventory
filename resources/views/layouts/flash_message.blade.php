<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))

      <div class="alert alert-{{ $msg }} alert-dismissable fade in">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          {{ Session::get('alert-' . $msg) }}
      </div>
      @endif
    @endforeach
</div> <!-- end .flash-message -->