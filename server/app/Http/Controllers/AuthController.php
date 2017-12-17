<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exception\HttpResponseException;
use Gregwar\Captcha\CaptchaBuilder;

class AuthController extends Controller
{
    // public function __construct(UserController $user) {
    //     $this->user = new $user;
    // }

    /**
     * Handle a login request to the application.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        try {
            $this->validate($request, [
                'username' => 'required|max:36',
                'password' => 'required',
            ]);
        } catch (ValidationException $e) {
            return $e->getResponse();
        }

        // if (isset($_COOKIE['phrase']) && $_COOKIE['phrase'] !== $request->input('captcha')) {
        //     return new JsonResponse([
        //         'message' => '验证码不正确'
        //     ], Response::HTTP_UNPROCESSABLE_ENTITY);
        // }

        try {
            $params = $this->getCredentials($request);

            // Attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($params)) {
                return $this->onUnauthorized($params);
            }
        } catch (JWTException $e) {
            // Something went wrong whilst attempting to encode the token
            return $this->onJwtGenerationError();
        }

        // All good so return the token
        return $this->onAuthorized($token);
    }

    /**
     * What response should be returned on invalid credentials.
     *
     * @return JsonResponse
     */
    protected function onUnauthorized($params)
    {
        $code = Response::HTTP_UNAUTHORIZED;
        $user = UserController::getUserByUsername($params['username']);

        // if ($user) {
        //     $user->login_attempts++;
        //     $user->save();

        //     if ($user->login_attempts > 3) {
        //         $code = Response::HTTP_TOO_MANY_REQUESTS;
        //     }
        // }

        // Too many login times, show captcha
        return new JsonResponse([
            'message' => '用户名或密码不正确'
        ], $code);
    }

    /**
     * What response should be returned on error while generate JWT.
     *
     * @return JsonResponse
     */
    protected function onJwtGenerationError()
    {
        return new JsonResponse([
            'message' => 'could_not_create_token'
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * What response should be returned on authorized.
     *
     * @return JsonResponse
     */
    protected function onAuthorized($token)
    {
        $user = $this->getUser();
        $user->login_attempts = 0;
        $user->save();

        return new JsonResponse([
            'token' => $token
        ]);
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    protected function getCredentials(Request $request)
    {
        return $request->only('username', 'password');
    }

    /**
     * Invalidate a token.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteInvalidate()
    {
        $token = JWTAuth::parseToken();

        $token->invalidate();

        return new JsonResponse(['message' => 'token_invalidated']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\Response
     */
    public function patchRefresh()
    {
        $token = JWTAuth::parseToken();

        $newToken = $token->refresh();

        return new JsonResponse([
            'message' => 'token_refreshed',
            'data' => [
                'token' => $newToken
            ]
        ]);
    }

    /**
     * Get authenticated user.
     *
     * @return App\Models\User
     */
    public function getUser()
    {
        return JWTAuth::parseToken()->authenticate();
    }

    /**
     * Get authenticated user.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserResp()
    {
        return new JsonResponse($this->getUser());
    }

    /**
     * Get captcha.
     *
     * @return CaptchaBuilder
     */
    public function getCaptcha()
    {
        $captcha = new CaptchaBuilder;
        $captcha->build();

        header('Content-type: image/jpeg');
        $captcha->output();

        // setcookie('phrase', $captcha->getPhrase());
        // $_COOKIE['phrase'] = $captcha->getPhrase();
    }
}
