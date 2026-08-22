@props([
    'modal_id',
    'modal_title'
])

<div class="modal fade" id="{{ $modal_id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered {{ $modal_dialog_class ?? '' }}">

        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">{{ $modal_title }}</h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>
            </div>

            <div class="modal-body">
            {{ $slot }}
            </div>

            <div class="modal-footer">
          
                {{ $modal_footer }}

            </div>

        </div>

    </div>

</div>