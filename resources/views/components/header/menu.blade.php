<header role="header" class="header top-header main-header p00 m00" id="top-header">
    <nav role="navigation" class="nav menu main-menu2 pt4 pb4 bg-primary">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-12 col-md-6">
                    <ul class="p00 m00 menu">
                       <li>
                           <a href="#">Seller Centre</a>
                       </li>
                       <li>
                           <a href="#">Start Selling</a>
                       </li>
                       <li class="d-flex align-items-center pt8 pb8 pl12 pr12">
                           Follow Us <a href="#" class="p00 ml8 mr5"><i class="ti ti-facebook"></i></a><a href="#" class="p00 mr5"><i class="ti ti-instagram"></i></a>
                       </li>
                    </ul>
                </div>
                <div class="col-12 col-md-6 d-flex justify-content-start justify-content-md-end">
                    <ul class="p00 m00 menu">
                       <li>
                           <a href="#">
                               <i class="ti ti-bell mr8"></i>Notifications
                           </a>
                       </li>
    
                       @guest
                        <li>
                           <a href="{{ route('account.login') }}">
                               Login
                           </a>
                       </li>
                       <li>
                           <a href="{{ route('account.register') }}">
                               Register
                           </a>
                       </li>
                       @endguest
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <nav role="navigation" class="nav menu main-menu pt16 pb16 border-bottom" id="top-menu">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-8 col-md-3 mb-xs-16">
                    <a href="{{ url('/') }}" class="d-block">
                        <img src="{{ asset('/img/logo.png') }}" height="32" alt="">
                    </a>
                </div>
                <div class="col-4 d-flex d-md-none justify-content-end mb-xs-16">
                    <button class="btn btn-primary btn-block">
                        <i class="ti ti-shopping-cart mr8"></i>Cart
                    </button>
                </div>
                <div class="col-12 col-md-7 d-flex justify-content-center">
                    <div class="search-input-wrapper">
                        <form class="search-box d-flex align-items-center" ref="searchForm" :action="$page.props.baseUrl+'/company/search?q='+searchqtext" method="get">
                            <i class="ti ti-search font18"></i>
                            <input type="text" name="q" v-model="searchqtext" @keypress="searchq" class="form-control" placeholder="Search">
                        </form>
                    </div>
                </div>
                <div class="col-4 col-md-2 d-none d-md-flex justify-content-end">
                    <button class="btn btn-primary btn-block">
                        <i class="ti ti-shopping-cart mr8"></i>Cart
                    </button>
                </div>
            </div>
        </div>
    </nav>
    <nav role="navigation" class="nav menu main-menu pt8 pb8 border-bottom" id="top-menu">
        <div class="container">
            <div class="row d-flex align-items-center">
                <ul class="p00 m00 menu">
                    @foreach($categories as $category)
                    <li>
                        <a href="{{ url('/category/'.$category->name) }}" class="d-flex align-items-center">
                            <span>{{ $category->name }}</span>
                            @if( count($category->sub_cats) > 0 )
                            <i class="ml8 ti ti-angle-down"></i>
                            @endif
                        </a>
                        @if( count($category->sub_cats) > 0 )
                        <ul>
                            @foreach($category->sub_cats as $subcategory)
                            <li>
                                <a href="{{ url('/category/'.$category->name.'/'.$subcategory->name) }}">{{ $subcategory->name }}</a>
                            </li>
                            @endforeach
                        </ul>
                        @endif
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>
</header>