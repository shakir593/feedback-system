@extends('backend.layout.layout')
@php
    $title='Add New Comment';
    $subTitle = 'Add New Comment';
@endphp
@section('css')
  <link href="{{asset('backend/assets/summernote/summernote-bs5.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">
@endsection
@section('content')

    <div class="row gy-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">Add New Comment</h6>
                    
                </div>
                <div class="card-body">
                    @if(Session::has('failed'))
                        <div class="alert alert-danger bg-danger-50 text-danger-600 border-danger-50 px-24 py-11 mb-0 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between my-2" role="alert">
                            {{ Session::get('failed') }}
                            <button class="remove-button text-danger-600 text-xxl line-height-1">
                                <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                            </button>
                        </div>
                    @endif
                    <form method = "post" action = "{{ route('feedback.save_comment',$feedback_details->id) }}"  enctype = "multipart/form-data" id = "comment-form">
                        @csrf
                        <div class="row gy-3">
                            <div class="col-6">
                                <label class="form-label">User Name</label>
                                <input type="text" name="name" value = "{{auth()->user()->name}}" class="form-control @error('name') is-invalid @enderror" readonly>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                             <div class="col-6">
                                <label class="form-label">Date</label>
                                <input type="date" name="date" class="form-control @error('date') is-invalid @enderror">
                                @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Mention Users</label>
                                <input name="users" id="usersInput" placeholder="Type @ to search users" class="form-control tagify-mobile">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Comment</label>
                                <textarea name="detailed_description" class="form-control @error('detailed_description') is-invalid @enderror" rows="4" cols="50" placeholder="Enter a description..." id = "summernote"></textarea>
                                @error('detailed_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class = "col-4">
                                <button type = "submit" class="btn btn-primary text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2">
                                    Add Comment
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- card end -->
        </div>
    </div>
            
@endsection
@section('script')

<script src="{{asset('backend/assets/summernote/summernote-bs5.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
 <script>

        let table = new DataTable("#dataTable");

</script>
               
<script>
    $('#summernote').summernote({
    placeholder: 'Hello stand alone ui',
    tabsize: 2,
    height: 200,
    toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['view', ['fullscreen', 'codeview', 'help']]
    ]
    });
</script>

<script>
const input = document.querySelector('#usersInput');

const tagify = new Tagify(input, {
    mode: 'mix',
    pattern: /@/,
    enforceWhitelist: true,
    whitelist: [],
    dropdown: {
        enabled: 1,
        position: 'input',
        highlightFirst: true,
        closeOnSelect: true,
        maxItems: 10,
        appendTo: 'body',
        classname: 'tagify-mobile',
        mobile: true,
        style: {
            width: '100%',
        }
    }
});

let controller;

tagify.on('input', async e => {
    const { value, prefix } = e.detail;
    if (prefix !== '@') return;

    const query = value.trim();
    if (controller) controller.abort();
    controller = new AbortController();

    try {
        const res = await fetch(`/dashboard/fetch-user?q=${query}`, {
            signal: controller.signal
        });
        const users = await res.json();
        tagify.settings.whitelist = users;
        tagify.dropdown.show.call(tagify, value);
    } catch (err) {
        console.warn(err);
    }
});

document.querySelector('#comment-form').addEventListener('submit', function (e) {
    
    const mentions = tagify.value
        .filter(item => typeof item === 'object' && item.prefix === '@');
        mentions.forEach((user, index) => {
        const idInput = document.createElement('input');
        idInput.type = 'hidden';
        idInput.name = `users_data[${index}][id]`;
        idInput.value = user.id;
        document.querySelector('#comment-form').appendChild(idInput);
        
        const nameInput = document.createElement('input');
        nameInput.type = 'hidden';
        nameInput.name = `users_data[${index}][name]`;
        nameInput.value = user.value;
        document.querySelector('#comment-form').appendChild(nameInput);
    });
});
</script>



@endsection
