<form method="post" action="{{ $action }}" class="" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    @csrf
    <div class="modal-dialog modal-{{ $size ?? 'md' }}">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">{{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                {!! $body !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn  btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn  btn-{{ $submit_class ?? 'primary' }}">{{ $submit_text }}</button>
            </div>
        </div>
    </div>
</form>
