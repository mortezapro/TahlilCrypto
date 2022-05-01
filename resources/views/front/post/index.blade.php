@extends($activeTheme->layout_path)
@section("head")
    <title>{{ $post->seo_title }}</title>
    <meta name="description" content="{{ $post->seo_description }}">
@endsection
@section("content")
    <div class="border-bottom border-primary border-1 opacity-1"></div>
    <section>
        <div class="container position-relative" data-sticky-container>
            <div class="row">
                <!-- Main Content START -->
                <div class="col-lg-8 mb-5 post-content">
                    <a href="#" class="badge bg-danger-soft text-danger mb-2"><i class="fas fa-circle me-2 small fw-bold"></i>Video</a>
                    <span class="ms-2 small">Updated: {{ date('d M', strtotime($post->updated_at)) }}</span>
                    <h1 class="h3">{{ $post->title }}</h1>

                    <!-- Youtube iframe video -->
                    <div class="ratio ratio-16x9 overflow-hidden rounded my-4">
                        <img class="fit-cover" src="{{ asset("storage/post-thumbnail/default")."/".$post->thumbnail }}" alt="">
                    </div>
                    {!! $post->content !!}
                    <div id="comment-area">
                        <h3>{{ $post->comments_count }} comments</h3>
                        @foreach($post->comments as $comment)
                            <div class="my-4 d-flex">
                                <img class="avatar avatar-md rounded-circle float-start me-3" src="{{ asset("theme/images/user/avatar.png") }}" alt="avatar">
                                <div>
                                    <div class="mb-2">
                                        <h5 class="m-0">{{ $comment->user->name }}</h5>
                                        <span class="me-3 small">{{ date('Y-m-d', strtotime($comment->created_at)) }}</span>
                                        <a href="javascript:void(0);" data-comment-id="{{ $comment->id }}" data-user="{{ $comment->user->name }}" class="text-body fw-normal reply-comment">Reply</a>
                                    </div>
                                    <p>{{ $comment->content }}</p>
                                </div>
                            </div>
                            @if($comment->reply)
                                @foreach($comment->reply as $reply)
                                    <div class="my-4 d-flex ps-3 ps-md-5">
                                        <img class="avatar avatar-md rounded-circle float-start me-3" src="{{ asset("theme/images/user/avatar.png") }}" alt="avatar">
                                        <div>
                                            <div class="mb-2">
                                                <h5 class="m-0">{{ $reply->user->name }}</h5>
                                                <span class="me-3 small">{{ date('Y-m-d', strtotime($reply->created_at)) }}</span>
                                                <a href="javascript:void(0);" class="text-body fw-normal reply-comment" data-comment-id="{{ $reply->id }}" data-user="{{ $reply->user->name }}">Reply</a>
                                            </div>
                                            <p>{{ $reply->content }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        @endforeach
                    </div>

                    <div>
                        <h3>Leave a Comment</h3>
                        <form class="row g-3 mt-2" method="post" action="{{ route("comments.store",["entity"=>"PostModel"]) }}" id="comment-form">
                            @csrf
                            <div class="col-12">
                                <div class="messages border border-primary p-3 rounded"  style="display:none">

                                </div>
                            </div>
                            <div class="col-12">
                                <label for="content" class="form-label">Your Comment *</label>
                                <textarea class="form-control" rows="3" name="content" id="content"></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-submit-comment">Post comment</button>
                            </div>
                        </form>
                    </div>
                    <div class="mt-5">
                        <h2 class="my-3"><i class="bi bi-symmetry-vertical me-2"></i>Related posts</h2>
                        <div class="tiny-slider arrow-hover arrow-dark arrow-round">
                            <div class="tiny-slider-inner"
                                 data-autoplay="true"
                                 data-hoverpause="true"
                                 data-gutter="24"
                                 data-arrow="true"
                                 data-dots="false"
                                 data-items-xl="2"
                                 data-items-xs="1">
                                @foreach($relatedPosts as $related)
                                    <div class="card">
                                        <!-- Card img -->
                                        <div class="position-relative">
                                            <img class="card-img" src="{{ asset("storage/post-thumbnail/md.")."/".$related->thumbnail }}" alt="Card image">
                                            <div class="card-img-overlay d-flex align-items-start flex-column p-3">
                                                <div class="w-100 mt-auto">
                                                    @foreach($related->categories as $category)
                                                        <a href="#" class="badge bg-info mb-2"><i class="fas fa-circle me-2 small fw-bold"></i>{{ $category->title }}</a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body px-0 pt-3">
                                            <h5 class="card-title"><a href="{{ route("posts.show",["post"=>$related->slug]) }}" class="btn-link text-reset fw-bold">{{ $related->title }}</a></h5>
                                            <!-- Card info -->
                                            <ul class="nav nav-divider align-items-center d-none d-sm-inline-block">
                                                <li class="nav-item">
                                                    <div class="nav-link">
                                                        <div class="d-flex align-items-center position-relative">
                                                            <div class="avatar avatar-xs">
                                                                <img class="avatar-img rounded-circle" src="{{ asset("theme/images/user/avatar.png") }}" alt="avatar">
                                                            </div>
                                                            <span class="ms-3">by <a href="#" class="stretched-link text-reset btn-link">{{ $related->user->name }}</a></span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="nav-item">{{ date('d M', strtotime($related->created_at)) }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div> <!-- Slider END -->
                    </div>
                </div>
                <div class="col-lg-4">
                    <div>
                        <div class="bg-light rounded p-3 p-md-4">
                            <div class="d-flex mb-3">
                                <a class="flex-shrink-0" href="#">
                                    <div class="avatar avatar-xl border border-4 border-danger rounded-circle">
                                        <img class="avatar-img rounded-circle" src="{{ asset("theme/images/user/avatar.png") }}" alt="avatar">
                                    </div>
                                </a>
                                <div class="flex-grow-1 ms-3">
                                    <span>Hello, I'm </span>
                                    <h3 class="mb-0">{{ $post->user->name }}</h3>
                                    <p>{{ $post->user->job }}</p>
                                </div>
                            </div>
                            <p>{{ $post->user->bio }}</p>
                            <a href="#" class="btn btn-danger-soft btn-sm ">View articles</a>
                        </div>

                        <div data-sticky data-margin-top="80" data-sticky-for="767">
                            <div class="post-link-area">
                                <h5 class="mt-5 mb-3">Table of Contents</h5>
                            </div>
                            <h4>Share this article</h4>
                            <ul class="nav text-white-force">
                                <li class="nav-item">
                                    <a class="nav-link icon-md rounded-circle me-2 mb-2 p-0 fs-5 bg-facebook" href="#">
                                        <i class="fab fa-facebook-square align-middle"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link icon-md rounded-circle me-2 mb-2 p-0 fs-5 bg-twitter" href="#">
                                        <i class="fab fa-twitter-square align-middle"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link icon-md rounded-circle me-2 mb-2 p-0 fs-5 bg-linkedin" href="#">
                                        <i class="fab fa-linkedin align-middle"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link icon-md rounded-circle me-2 mb-2 p-0 fs-5 bg-pinterest" href="#">
                                        <i class="fab fa-pinterest align-middle"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link icon-md rounded-circle me-2 mb-2 p-0 fs-5 bg-primary" href="#">
                                        <i class="far fa-envelope align-middle"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section("script")
    <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
    <script>
        let data_reply_id,data_user,content;
        let submit = $(".btn-submit-comment");
        $(document).on("click",".reply-comment",(function( event ) {
            data_reply_id = $(this).attr("data-comment-id");
            data_user = $(this).attr("data-user");
            $(".messages").html("<strong>"+"Reply To "+ data_user + "</strong>").append('<button class="btn btn-danger btn-sm ms-2 mb-0 cancel-reply">Cancel</button>').show();
        }));
        $(document).on("click",".cancel-reply",(function( event ) {
            data_reply_id = null;
            data_user = null;
            $(".messages").html("").hide();
        }));
        $(document).on("submit","#comment-form",(function( event ) {
            content = $("#content").val();
            var formData = {
                content: content,
                reply_id: data_reply_id,
                "_token": "{{ csrf_token() }}",
            };
            event.preventDefault();
            if(content){
                $.ajax({
                    type:'POST',
                    url:"{{ route("comments.store",["entity"=>"PostModel"]) }}",
                    data: formData,
                    success:function(data) {
                        $("#content").val("");
                        submit.attr("disabled",true);
                        $(".messages").html("<h6>your comment insert successfully. please wait for accept it.</h6><h6>Please dont send request again</h6>").show();
                        data_reply_id = null;
                        data_user = null;
                        submit.html("Post Comment (wait ...)");
                        setTimeout(function (e) {
                            submit.attr("disabled",false);
                            submit.html("Post Comment");
                            $(".messages").html("").hide();
                        },4000)
                    }
                });
            } else {
                $(".messages").html("the content field is required").show();
            }

        }));
        let title;
        $(document).ready(function () {
            // when click on title of table content, page will scrolled to link
            $(".post-content").find("h2").each(function (index) {
                $(this).attr( 'id', 'link-title-'+index );
                title = $(this).text();
                $(".post-link-area").append(
                    '<div class="d-flex position-relative mb-3">'
                    +'<span class="me-3 fa-fw fw-bold fs-3 opacity-5">' + index + '</span>'
                    +'<h6><a href="#link-title-'+index+'" class="stretched-link">' + title + '</a></h6>'
                    +'</div>'
                );
            })
        })
    </script>
@endsection
