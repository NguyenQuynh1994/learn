<!-- sidebar-collapse -->
<div class="sidebar-collapse">
    <!-- side-menu -->
    <ul class="nav" id="side-menu">
        <li>
            <!-- user image section-->
            <div class="user-section">
                <div class="user-section-inner">
                    <img src={{ url('assets/img/user.jpg') }} alt="">
                </div>
                <div class="user-info">
                    <div>Jonny <strong>Deen</strong></div>
                    <div class="user-text-online">
                        <span class="user-circle-online btn btn-success btn-circle "></span>&nbsp;Online
                    </div>
                </div>
            </div>
            <!--end user image section-->
        </li>
        <li class="sidebar-search">
            <!-- search section-->
            <div class="input-group custom-search-form">
                <input type="text" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
            <!--end search section-->
        </li>
        <li class="selected">
            <a href="#"><i class="fa fa-dashboard fa-fw"></i>Dashboard</a>
        </li>
        <li>
            <a href="{{ route('admin.levels.index') }}">
                <i class="fa fa-flask fa-fw"></i>Level Manage
            </a>
        </li>
        <li>
            <a href="{{ route('admin.categories.index') }}"><i class="fa fa-table fa-fw"></i>Category Manage<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="{{ route('admin.categories.index') }}">Category Data</a>
                </li>
                <li>
                    <a href="{{ route('admin.categories.create') }}">Create Category</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{ route('admin.lessons.index') }}"><i class="fa fa-edit fa-fw"></i>Lesson Manage</a>
        </li>
        <li>
            <a href="{{ route('admin.lessonWords.index') }}"><i class="fa fa-edit fa-fw"></i>LessonWord Manage<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="{{ route('admin.lessonWords.index') }}">LessonWord Data</a>
                </li>
                <li>
                    <a href="{{ route('admin.lessonWords.create') }}">Create LessonWord</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#"><i class="fa fa-edit fa-fw"></i>User Manage</a>
        </li>
    </ul>
    <!-- end side-menu -->
</div>
<!-- end sidebar-collapse -->
