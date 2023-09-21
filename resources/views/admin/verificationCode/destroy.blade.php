<form action="{{ route('verificationCode.destroy', $id) }}" method ="POST" >
    @csrf
    {{ method_field('DELETE') }}
    <input type="submit" class="btn btn-danger" value="Eliminar" onclick="return EliminarRegistro('Eliminar Permiso')">
</form>
