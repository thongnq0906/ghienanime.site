<form action="{{ route('gomnhom') }}" method="post">
    @csrf
    <select name="nhom" id="">
        <option value="11">Nhóm 11</option>
        <option value="12">Nhóm 12</option>
        <option value="13">Nhóm 13</option>
        <option value="14">Nhóm 14</option>
        <option value="15">Nhóm 15</option>
        <option value="16">Nhóm 16</option>
        <option value="17">Nhóm 17</option>
        <option value="18">Nhóm 18</option>
        <option value="19">Nhóm 19</option>
        <option value="20">Nhóm 20</option>
    </select>
    <button>ok</button>
    @foreach ($product as $p)
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="{{ $p->id }}" id="thu{{ $p->id }}" name="chon[]">
            <label class="form-check-label" for="thu{{ $p->id }}">{{ $p->name }}</label>
            <input type="text" name="phan[]">
        </div>
    @endforeach
</form>

