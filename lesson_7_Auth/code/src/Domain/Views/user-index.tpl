<p>Список пользователей в хранилище</p>

<ul id="navigation">
    {% for user in users %}
        <li><a href="/user/profile/?id={{user.getIdUser()}}"> {{ user.getUserName() }} {{ user.getUserLastName() }}. День рождения: {{ user.getUserBirthday() | date('d.m.Y') }}</a>
                <form name="delete" action="/user/delete/" method="post">
                        <button name="delete" value="{{ user.getIdUser() }}">X</button>
                </form>
        </li>
    {% endfor %}
</ul>