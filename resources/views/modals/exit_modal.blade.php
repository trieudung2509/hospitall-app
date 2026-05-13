<!-- Exit Modal -->
<div id="exit-modal" class="modal fade">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title h6">{{translate('Exit Confirmation')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body text-left">
                <p class="mt-1">{{translate('Are you sure to exit without saving? Your changes will not be saved')}}</p>
                <div class="text-right">
                    <a href="{{ route('blog.index') }}" id="exit-link" class="btn btn-outline-info mt-2">{{translate('Exit')}}</a>
                    <button type="button" class="btn btn-primary mt-2" data-dismiss="modal">{{translate('Stay')}}</button>
                </div>
            </div>
        </div>
    </div>
</div><!-- /.modal -->
