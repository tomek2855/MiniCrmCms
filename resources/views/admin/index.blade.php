@extends('admin.layout')

@section('window')

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    @include('admin.sidebar')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        @include('admin.topbar')
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">@yield('content-title')</h1>
            @yield('content-links')
          </div>

        @if (session()->has('info'))
            <div class="alert alert-success">{{ session()->get('info', 'Ok') }}</div>
        @endif

        @yield('content')

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Example {{ date('Y') }}</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="logoutModalLabel">Na pewno wylogować?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Zamknij">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-footer" style="border-top: 0">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Anuluj</button>
          <a class="btn btn-primary" href="/admin/logout">Wyloguj</a>
        </div>
      </div>
    </div>
  </div>

  @stack('modals')

@endsection
