@extends('admin.adminBase')
@section('admin')
    <div class="container-fluid disable-text-selection">
        <div class="row">
            <div class="col-12">
                <div class="mb-3">
                    <h1>قائمة المستخدمين</h1>
                    <div class="text-zero top-right-button-container">
                        <a type="button" href="{{ route('users.add') }}"
                           class="btn btn-primary btn-lg top-right-button mr-1">{{__('مستخدم جديد')}}</a>
                    </div>
                    {{-- <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                         <ol class="breadcrumb pt-0">
                             <li class="breadcrumb-item">
                                 <a href="#">الكل</a>
                             </li>
                             <li class="breadcrumb-item">
                                 <a href="#">الدعم الدراسي</a>
                             </li>
                             <li class="breadcrumb-item active" aria-current="page">التحضيري</li>
                         </ol>
                     </nav>--}}

                </div>

                <div class="mb-2">
                    <a class="btn pt-0 pl-0 d-inline-block d-md-none" data-toggle="collapse" href="#displayOptions"
                       role="button" aria-expanded="true" aria-controls="displayOptions">
                        Display Options
                        <i class="simple-icon-arrow-down align-middle"></i>
                    </a>
                    <div class="collapse d-md-block" id="displayOptions">

                        <div class="d-block d-md-inline-block">
                            <div class="btn-group float-md-left mr-1 mb-1">
                                <button class="btn btn-outline-dark btn-xs dropdown-toggle" type="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    ترتيب حسب
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                </div>
                            </div>
                            <div class="search-sm d-inline-block float-md-left mr-1 mb-1 align-top">
                                <input placeholder="بحث...">
                            </div>
                        </div>
                        <div class="float-md-right">
                            <span class="text-muted text-small">Displaying 1-10 of 210 items </span>
                            <button class="btn btn-outline-dark btn-xs dropdown-toggle" type="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                20
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#">10</a>
                                <a class="dropdown-item active" href="#">20</a>
                                <a class="dropdown-item" href="#">30</a>
                                <a class="dropdown-item" href="#">50</a>
                                <a class="dropdown-item" href="#">100</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="separator mb-5"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 list" data-check-all="checkAll">

                @foreach($allData as $key => $user)

                    <div class="card d-flex flex-row mb-3">
                        <a class="d-flex">
                            <img
                                src=" {{ (!empty($user->profile_photo_path))? $user->profile_photo_path:asset('img/profiles/no image.png') }} "
                                alt="Fat Rascal"
                                class="list-thumbnail responsive border-0 card-img-left"/>

                        </a>
                        <div class="pl-2 d-flex flex-grow-1 min-width-zero">
                            <div
                                class="card-body align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero align-items-lg-center">
                                <a class="w-15 w-sm-100">
                                    <p class="list-item-heading mb-0 truncate">{{$user->first_name}}</p>
                                </a>
                                <a class="w-15 w-sm-100">
                                    <p class="list-item-heading mb-0 truncate">{{$user->last_name}}</p>
                                </a>
                                <p class="mb-0 text-muted text-small w-15 w-sm-100">{{$user->email}}</p>
                                <p class="mb-0 text-muted text-small w-15 w-sm-100">{{$user->created_at}}</p>
                                <div class="w-15 w-sm-100">
                                    @if($user->user_type == 'Teacher')
                                        <span class="badge badge-pill badge-primary">أستاذ</span>
                                    @elseif($user->user_type == 'Direction')
                                        <span class="badge badge-pill badge-warning">إدارة</span>
                                    @elseif($user->user_type == 'Student')
                                        <span class="badge badge-pill badge-success">تلميذ</span>
                                    @endif
                                </div>
                                <div>


                                    <div class="position-absolute card-top-buttons ">
                                        <a href="{{ route('users.edit',$user->id) }}"
                                           class="btn btn-outline-info icon-button">

                                            <i class="fa fa-pencil-square-o"></i></a>
                                        <a href="{{ route('users.delete',$user->id) }}"
                                           class="btn btn-outline-danger icon-button" id="delete">
                                            <i class="fa fa-trash-o"></i></a>

                                    </div>

                                </div>


                            </div>

                        </div>
                    </div>
                @endforeach


                <nav class="mt-4 mb-3">
                    <ul class="pagination justify-content-center mb-0">
                        <li class="page-item ">
                            <a class="page-link first" href="#">
                                <i class="simple-icon-control-start"></i>
                            </a>
                        </li>
                        <li class="page-item ">
                            <a class="page-link prev" href="#">
                                <i class="simple-icon-arrow-left"></i>
                            </a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="#">1</a>
                        </li>
                        <li class="page-item ">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">3</a>
                        </li>
                        <li class="page-item ">
                            <a class="page-link next" href="#" aria-label="Next">
                                <i class="simple-icon-arrow-right"></i>
                            </a>
                        </li>
                        <li class="page-item ">
                            <a class="page-link last" href="#">
                                <i class="simple-icon-control-end"></i>
                            </a>
                        </li>
                    </ul>
                </nav>

            </div>
        </div>
    </div>

@endsection
