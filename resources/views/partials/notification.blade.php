@if (session()->has('msg'))
    <div style="position:absolute;top:40px;right: 40px">
        <div class="toast hide  {{ session()->get('success') ? 'bg-sucsecss' : 'bg-danger' }}" role="alert"
            aria-live="assertive" data-delay="300000" aria-atomic="true">
            <div class="toast-header">
                <strong class="mr-auto">{{ config('app.name') }}</strong>
                <button type="button" class="m-l-5 mb-1 mt-1 close" data-dismiss="toast" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="toast-body" style="background-color: rgba(255, 255, 255, 0.85);">
                {{ session()->get('msg') }}
            </div>
        </div>
    </div>
    <script>
        $('.toast').toast('show');
        $(function() {
            $('.toast').toast('show');
        });
    </script>
@endif
