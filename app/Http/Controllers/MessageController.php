<?php

namespace App\Http\Controllers;

use App\Services\MessageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Exception;

class MessageController extends Controller
{
    /**
     * @var MessageService
     */
    private $messageService;

    /**
     * Construtor
     *
     * @param MessageService $messageService
     */
    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    /**
     * Exibe a view para envio de mensagens
     *
     * @return View
     */
    public function index(): View
    {
        return view('message.index');
    }

    /**
     * Envia uma mensagem via API
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function send(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'sessionName' => 'required|string',
                'number' => 'required|string|regex:/^\d+$/',
                'text' => 'required|string'
            ], [
                'sessionName.required' => 'O nome da sessão é obrigatório',
                'number.required' => 'O número do destinatário é obrigatório',
                'number.regex' => 'O número deve conter apenas dígitos',
                'text.required' => 'O texto da mensagem é obrigatório'
            ]);

            $result = $this->messageService->sendTextWithValidation(
                $request->input('sessionName'),
                $request->input('number'),
                $request->input('text')
            );

            if ($result['success']) {
                return response()->json($result, 200);
            } else {
                return response()->json($result, 400);
            }

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Verifica o status de uma sessão via API
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function status(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'sessionName' => 'required|string'
            ], [
                'sessionName.required' => 'O nome da sessão é obrigatório'
            ]);

            $result = $this->messageService->getSessionStatus(
                $request->input('sessionName')
            );

            if ($result['success']) {
                return response()->json($result, 200);
            } else {
                return response()->json($result, 400);
            }

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Lista canais de atendimento via API
     *
     * @return JsonResponse
     */
    public function listChannels(): JsonResponse
    {
        try {
            $result = $this->messageService->listChannels();

            if ($result['success']) {
                return response()->json($result, 200);
            } else {
                return response()->json($result, 400);
            }

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

