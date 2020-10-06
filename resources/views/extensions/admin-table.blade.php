<div class="card shadow mb-4">
    @if (($title && strlen($title)) || $search)
        <div class="card-header py-3">
            <div class="row">
                <div class="col-sm-6">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
                </div>
                @if ($search)
                    <div class="col-sm-4">
                        <input type="text" id="adminTable-search" class="form-control input-sm" placeholder="Wpisz wartość do wyszukania" name="search" value="{{ request()->get('search') }}" />
                    </div>
                    <div class="col-sm-2">
                        <button class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" onclick="resetSearchParam()" style="float: right"><i class="fas fa-trash fa-sm text-white-50"></i> Resetuj</button>
                        <span style="float: right">&nbsp;</span>
                        <button class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" onclick="addSearchParam()" style="float: right"><i class="fas fa-search fa-sm text-white-50"></i> Szukaj</button>
                    </div>
                @endif
            </div>
        </div>
    @endif
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    @foreach ($columns as $value)
                        <th>{{ $value }}</th>
                    @endforeach
                    @if ($buttonsColumn)
                        <th>Opcje</th>
                    @endif
                </tr>
                </thead>
                <tfoot>
                <tr>
                    @foreach ($columns as $value)
                        <th>{{ $value }}</th>
                    @endforeach
                    @if ($buttonsColumn)
                        <th>Opcje</th>
                    @endif
                </tr>
                </tfoot>
                <tbody>
                    @foreach($data as $item)
                        <tr>
                            @foreach ($columns as $key => $value)
                                @if (strpos($key, 'bool|') !== false)
                                    @php $key = substr($key, 5); @endphp
                                    <td style="width: 100px; text-align: center">
                                        @if ($item[$key])
                                            <span class="btn-circle btn-sm btn-success">
                                                <i class="fas fa-check"></i>
                                            </span>
                                        @else
                                            <span class="btn-circle btn-sm btn-danger">
                                                <i class="fas fa-times"></i>
                                            </span>
                                        @endif
                                    </td>
                                @elseif (strpos($key, 'fun|') !== false)
                                    @php $key = substr($key, 4); @endphp
                                    <td>{{ $functions->call($key, $item) }}</td>
                                @elseif ($key == 'id')
                                    <td style="width: 100px">{{ $item[$key] }}</td>
                                @else
                                    <td>{{ $item[$key] }}</td>
                                @endif
                            @endforeach
                            @if ($buttonsColumn)
                                <td style="width: 50px; text-align: center">
                                    <a class="btn-circle btn-sm btn-info" href="{{ $buttonsColumn }}/edit/{{ $item->id }}" aria-label="Edytuj">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $links !!}
        </div>
    </div>
</div>

<script>
    function addSearchParam() {
        let val = $('#adminTable-search').val();

        window.location.search = 'search=' + val;
    }

    function resetSearchParam() {
        window.location.search = '';
    }
</script>
