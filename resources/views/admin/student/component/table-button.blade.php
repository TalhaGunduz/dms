<a href="{{ route('admin.'.$model.'.edit',['id' => $item->id])}}" class="btn btn-warning" >Düzenle</a>
<a href="{{ route('admin.'.$model.'.destroy',['id' => $item->id])}}"  class="btn btn-danger" data-id="{{$item->id}}">Sil</a>
<a href="{{ route('admin.student.show', ['id' => $item->id]) }}" class="btn btn-info">İçeriği görüntüle</a>


