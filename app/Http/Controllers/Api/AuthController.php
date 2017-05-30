<?php
namespace SON\Http\Controllers\Api;

use Illuminate\Http\Request;
use SON\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;

/**
 * Created by PhpStorm.
 * User: roque
 * Date: 22/05/17
 * Time: 10:55
 */

class  AuthController extends Controller
{
    /**
     * @SWG\Info(title="School of Net - SON Financeiro API", version="0.0.1")
     */

    /**
     * Requisitar token JWT
     *
     * @SWG\Post(
     *     path="/api/login",
     *     @SWG\Parameter(
     *          name="body", in="body", required=true,
     *          @SWG\Schema(
     *              @SWG\Property(property="email", type="string"),
     *              @SWG\Property(property="password", type="string"),
     *          )
     *     ),
     *     @SWG\Response(
     *      response="200", description="Token JWT"
     *     )
     * )
     */
    public function login( Request $request )
    {
        //pega o email e password
        $credentials = $request->only('email','password');

        try {
            //chama a facade JWTAuth
            $token = \JWTAuth::attempt($credentials);
        }catch ( JWTException $ex ) {
            return response()->json(['error'=>'could_not_crete_token'], 500);
        }

        if(!$token){
            return response()->json(['error'=>'invalid_Credentials'], 401);
        }

        return response()->json(compact('token'));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(){
        Try{
            //chama a facade JWTAuth e invalida o token
            \JWTAuth::invalidate();
        } catch ( JWTException $ex) {
            return response()->json(['error'=>'coul_not_validate_token'], 500);
        }

        return response()->json([], 204);
    }

    public function refreshToken( Request $request ){
        Try{
            //chama a facade JWTAuth para pegar o objeto que manipula o token
            $bearerToken = \JWTAuth::setRequest($request)->getToken();
            // Renova e gera um novo token
            $token = \JWTAuth::refresh($bearerToken);
        } catch ( JWTException $ex) {
            return response()->json(['error'=>'coul_not_refresh_token'], 500);
        }

        return response()->json(compact('token'));
    }
}