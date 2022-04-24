<div style="margin: 0 auto; width: 250px">
    <form action="{{route("frontend.forgetpasswordpost")}}" method="post">
        @csrf
        <h4>Şifre Sıfırla</h4>
        <p>{{$user->eposta}}</p>
        <input name="eposta" type="text" value="{{$user->eposta}}" hidden>
        <div>
            <label for="sifre">Yeni Şifre</label><br>
            <input type="password" name="sifre">
        </div>
        <div style="margin-top:5px ">
            <button type="kaydet">Kaydet</button>
        </div>

    </form>
</div>

