@extends('admin.layout.master')

@section('content')
        <div class="page-body">

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <h3>Create Promotion
                                    <small>AndBaazar Admin panel</small>
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item">Promotion </li>
                                <li class="breadcrumb-item active">Create Promotion</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="card tab2-card">
                    <div class="card-header">
                        <h5>Create New Promotion</h5>
                    </div>
                    <div class="card-body">
                                <form class="needs-validation" novalidate="" action="{{ route('promotion.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group row">
                                                <label for="title" class="col-xl-3 col-md-4">Title <span>*</span></label>
                                                <input class="form-control col-md-8" name="title" id="title" type="text" required="">
                                            </div>
                                            <div class="form-group row">
                                              <label for="description" class="col-xl-3 col-md-4"> Description <span>*</span></label>
                                             <textarea name="description" id="" class="form-control"  value="{{old('description')}}" class="form-control" id="description" placeholder="Description" rows="3"></textarea>
                                            </div>
                                              <div class="form-group row">
                                                <label class="col-xl-3 col-md-4"></label>
                                                <div class="checkbox checkbox-primary col-md-8">
                                                    <button type="submit"  class="btn btn-primary">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->

        </div>
@endsection
