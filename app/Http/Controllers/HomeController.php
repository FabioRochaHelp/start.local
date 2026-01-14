<?php

namespace App\Http\Controllers;

use App\Models\CanalAtendimento;
use App\Services\MessageService;
use Exception;

class HomeController extends Controller
{
    public function index(MessageService $messageService)
    {
        $channel = CanalAtendimento::first();
        $channelStatus = null;
        $channelActive = null;
        $channelError = null;

        if ($channel && $channel->channelValue) {
            try {
                $statusResult = $messageService->getSessionStatus($channel->channelValue);

                if (!empty($statusResult['success'])) {
                    $channelStatus = $statusResult['status'] ?? 'UNKNOWN';
                    $channelActive = $statusResult['active'] ?? null;
                } else {
                    $channelError = $statusResult['error'] ?? 'Erro ao obter status do canal';
                }
            } catch (Exception $e) {
                $channelError = $e->getMessage();
            }
        } else {
            $channelError = 'Nenhum canal configurado';
        }

        return view('home', [
            'channel' => $channel,
            'channelStatus' => $channelStatus,
            'channelActive' => $channelActive,
            'channelError' => $channelError,
        ]);
    }

    public function landpage()
    {
        return view('landpage.index');
    }
}
