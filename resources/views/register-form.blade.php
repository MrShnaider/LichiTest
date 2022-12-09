<main class="main" data-main>
    <div class="error-message" data-error></div>
    <form class="form" action="{{ route('register') }}" data-form>
        <label>
            <span>Имя</span>
            <input type="text" name="name">
        </label>
        <label>
            <span>Фамилия</span>
            <input type="text" name="surname">
        </label>
        <label>
            <span>E-mail</span>
            <input type="email" name="email">
        </label>
        <label>
            <span>Пароль</span>
            <input type="password" name="password">
        </label>
        <label>
            <span>Повторите пароль</span>
            <input type="password" name="password_repeat">
        </label>
        @csrf
        <button type="submit">Отправить</button>
    </form>
</main>

<script>
const main = document.querySelector('[data-main]');
const form = document.querySelector('[data-form]');
const error = {
    node: document.querySelector('[data-error]'),
    message: '',
    setMessage: (m) => {
        error.message = m;
        error.render();
    },
    render: () => {
        error.node.textContent = error.message;
    }
}

form.addEventListener('submit', async (event) => {
    event.preventDefault();
    const response = await sendRegisterResponse();
    if (!response.ok)
        error.setMessage((await response.json()).message);
    else
        handleSuccessRegistration();
})

async function sendRegisterResponse() {
    return await fetch(form.getAttribute('action'), {
        method: 'POST',
        body: new FormData(form),
    });
}

function handleSuccessRegistration() {
    main.innerHTML = 'Регистрация успешно завершена';
    main.setAttribute('style', 'color: green');
}
</script>

<style>
.main {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    row-gap: 1em;
    height: 100%;
    font-size: 14px;
    font-family: 'Nunito', sans-serif;
}
.error-message {
    color: tomato;
}
.form {
    display: flex;
    flex-direction: column;
    row-gap: 0.9em;
    padding: 2em;
    border: 1px solid black;
    border-radius: 10px;
}

.form label {
    display: flex;
    flex-direction: column;
    row-gap: 1px;
}

.form input {
    height: 1.8em;
}
</style>
