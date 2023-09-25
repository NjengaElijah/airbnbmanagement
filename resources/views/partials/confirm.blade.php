<form method="post" action="{{ $action }}" class="" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    @csrf
    @method($method??"post")
    <div class="modal-dialog modal-{{ $size ?? 'md' }}">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4 text-danger" id="myLargeModalLabel">{!! $title??'<i class="fas fa-exclamation-triangle"></i>
                        Are you sure?' !!}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
               
                {!! $body !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn  btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit"
                    class="btn  btn-{{ $submit_class ?? 'danger' }}">{{ $submit_text ?? 'Yes, Proceed' }}</button>
            </div>
        </div>
    </div>
</form>
