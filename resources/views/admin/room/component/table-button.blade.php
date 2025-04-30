<a href="{{ route('admin.'.$model.'.edit',['id' => $item->id])}}" class="btn btn-warning" >Düzenle</a>
<a href="{{ route('admin.'.$model.'.destroy',['id' => $item->id])}}"  class="btn btn-danger" data-id="{{$item->id}}">Sil</a>

