<?php


namespace App\Answers\Feat5;


use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function getForm()
    {
        return view('register-form');
    }

    public function register(Request $request): JsonResponse
    {
        try {
            $regRequest = new RegistrationRequest($request);
            $regRequest->ensureDataIsValid();
            $this->handleRegistration($regRequest);

            return new JsonResponse(['message' => 'Пользователь успешно создан'], 201);
        } catch (InputsAreEmpty) {
            return new JsonResponse(['message' => 'Некоторые поля не заполнены'], 422);
        } catch (InvalidEmail) {
            return new JsonResponse(['message' => 'Email не является валидным'], 422);
        } catch (DifferentPasswords) {
            return new JsonResponse(['message' => 'Пароли не совпадают'], 422);
        } catch (EmailExists) {
            return new JsonResponse(['message' => 'Такой email уже существует'], 422);
        } catch (\Exception) {
            return new JsonResponse(['message' => 'Ошибка сервера'], 500);
        }
    }

    private function handleRegistration(RegistrationRequest $request)
    {
        $email = $request->email;
        $userExists = UserRepository::isUserWithEmailExists($email);
        $message = $userExists ? 'Безуспешно' : 'Успешно';
        file_put_contents(
            app()->storagePath('logs/registration.log'),
            "Пользователь с email'ом $email регистрировался. $message.\n",
            FILE_APPEND
        );
        if ($userExists) throw new EmailExists();
    }
}
