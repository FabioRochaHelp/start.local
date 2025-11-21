<?php

namespace App\Http\Controllers;

use App\Services\AteatendService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Exception;

class AteatendController extends Controller
{
    /**
     * @var AteatendService
     */
    private $ateatendService;

    /**
     * Construtor
     *
     * @param AteatendService $ateatendService
     */
    public function __construct(AteatendService $ateatendService)
    {
        $this->ateatendService = $ateatendService;
    }

    /**
     * Exibe a view principal de pacientes
     *
     * @return View
     */
    public function index(): View
    {
        return view('ateatend.index');
    }

    /**
     * Exibe a lista de pacientes com paginação
     *
     * @param Request $request
     * @return View|JsonResponse
     */
    public function list(Request $request)
    {
        try {
            $limit = $request->input('limit', 100);
            $offset = $request->input('offset', 0);

            $result = $this->ateatendService->getAllPacientes(
                (int) $limit,
                (int) $offset
            );

            if ($request->expectsJson()) {
                if ($result['success']) {
                    return response()->json($result, 200);
                } else {
                    return response()->json($result, 400);
                }
            }

            $pacientes = $result['success'] ? ($result['data'] ?? []) : [];
            $pagination = $result['success'] ? ($result['pagination'] ?? []) : [];
            $error = $result['success'] ? null : ($result['error'] ?? 'Erro desconhecido');

            return view('ateatend.list', compact('pacientes', 'pagination', 'error'));

        } catch (Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => $e->getMessage()
                ], 500);
            }

            return view('ateatend.list', [
                'pacientes' => [],
                'pagination' => [],
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Obtém o total de pacientes
     *
     * @return JsonResponse
     */
    public function count(): JsonResponse
    {
        try {
            $result = $this->ateatendService->getCount();

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
     * Busca pacientes por nome
     *
     * @param Request $request
     * @param string $nome
     * @return View|JsonResponse
     */
    public function searchByNome(Request $request, string $nome = null)
    {
        try {
            $nome = $nome ?? $request->input('nome');

            if (empty($nome)) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'error' => 'Nome é obrigatório'
                    ], 400);
                }

                return view('ateatend.search', [
                    'pacientes' => [],
                    'error' => 'Nome é obrigatório',
                    'searchType' => 'nome',
                    'searchValue' => ''
                ]);
            }

            $result = $this->ateatendService->getPacienteByNome($nome);

            if ($request->expectsJson()) {
                if ($result['success']) {
                    return response()->json($result, 200);
                } else {
                    return response()->json($result, 404);
                }
            }

            $pacientes = $result['success'] ? ($result['data'] ?? []) : [];
            $error = $result['success'] ? null : ($result['error'] ?? 'Nenhum paciente encontrado');

            return view('ateatend.search', compact('pacientes', 'error', 'nome'))
                ->with('searchType', 'nome')
                ->with('searchValue', $nome);

        } catch (Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => $e->getMessage()
                ], 500);
            }

            return view('ateatend.search', [
                'pacientes' => [],
                'error' => $e->getMessage(),
                'searchType' => 'nome',
                'searchValue' => $nome ?? ''
            ]);
        }
    }

    /**
     * Busca paciente por ID
     *
     * @param Request $request
     * @param int|null $id
     * @return View|JsonResponse
     */
    public function searchById(Request $request, int $id = null)
    {
        try {
            $id = $id ?? $request->input('id');

            if (empty($id)) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'error' => 'ID é obrigatório'
                    ], 400);
                }

                return view('ateatend.detail', [
                    'paciente' => null,
                    'error' => 'ID é obrigatório'
                ]);
            }

            $result = $this->ateatendService->getPacienteById((int) $id);

            if ($request->expectsJson()) {
                if ($result['success']) {
                    return response()->json($result, 200);
                } else {
                    return response()->json($result, 404);
                }
            }

            $paciente = $result['success'] ? ($result['data'] ?? null) : null;
            $error = $result['success'] ? null : ($result['error'] ?? 'Paciente não encontrado');

            return view('ateatend.detail', compact('paciente', 'error'));

        } catch (Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => $e->getMessage()
                ], 500);
            }

            return view('ateatend.detail', [
                'paciente' => null,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Busca pacientes por documento
     *
     * @param Request $request
     * @param string $documento
     * @return View|JsonResponse
     */
    public function searchByDocumento(Request $request, string $documento = null)
    {
        try {
            $documento = $documento ?? $request->input('documento');

            if (empty($documento)) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'error' => 'Documento é obrigatório'
                    ], 400);
                }

                return view('ateatend.search', [
                    'pacientes' => [],
                    'error' => 'Documento é obrigatório',
                    'searchType' => 'documento',
                    'searchValue' => ''
                ]);
            }

            $result = $this->ateatendService->getPacienteByDocumento($documento);

            if ($request->expectsJson()) {
                if ($result['success']) {
                    return response()->json($result, 200);
                } else {
                    return response()->json($result, 404);
                }
            }

            $pacientes = $result['success'] ? ($result['data'] ?? []) : [];
            $error = $result['success'] ? null : ($result['error'] ?? 'Nenhum paciente encontrado');

            return view('ateatend.search', compact('pacientes', 'error', 'documento'))
                ->with('searchType', 'documento')
                ->with('searchValue', $documento);

        } catch (Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => $e->getMessage()
                ], 500);
            }

            return view('ateatend.search', [
                'pacientes' => [],
                'error' => $e->getMessage(),
                'searchType' => 'documento',
                'searchValue' => $documento ?? ''
            ]);
        }
    }
}

