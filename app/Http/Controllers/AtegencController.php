<?php

namespace App\Http\Controllers;

use App\Services\AtegencService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Exception;

class AtegencController extends Controller
{
    /**
     * @var AtegencService
     */
    private $ategencService;

    /**
     * Construtor
     *
     * @param AtegencService $ategencService
     */
    public function __construct(AtegencService $ategencService)
    {
        $this->ategencService = $ategencService;
    }

    /**
     * Exibe a view principal de agendamentos
     *
     * @return View
     */
    public function index(): View
    {
        return view('ateagenc.index');
    }

    /**
     * Exibe a lista de agendamentos com paginação
     *
     * @param Request $request
     * @return View|JsonResponse
     */
    public function list(Request $request)
    {
        try {
            $limit = $request->input('limit', 100);
            $offset = $request->input('offset', 0);
            $completo = $request->input('completo', false);
            $detalhes = $request->input('detalhes', false);

            if ($detalhes) {
                $result = $this->ategencService->getAllDetalhes(
                    (int) $limit,
                    (int) $offset
                );
            } else {
                $result = $this->ategencService->getAllAgendamentos(
                    (int) $limit,
                    (int) $offset,
                    (bool) $completo
                );
            }

            if ($request->expectsJson()) {
                if ($result['success']) {
                    return response()->json($result, 200);
                } else {
                    return response()->json($result, 400);
                }
            }

            $agendamentos = $result['success'] ? ($result['data'] ?? []) : [];
            $pagination = $result['success'] ? ($result['pagination'] ?? []) : [];
            $error = $result['success'] ? null : ($result['error'] ?? 'Erro desconhecido');

            return view('ateagenc.list', compact('agendamentos', 'pagination', 'error', 'completo', 'detalhes'));

        } catch (Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => $e->getMessage()
                ], 500);
            }

            return view('ateagenc.list', [
                'agendamentos' => [],
                'pagination' => [],
                'error' => $e->getMessage(),
                'completo' => false,
                'detalhes' => false
            ]);
        }
    }

    /**
     * Obtém o total de agendamentos
     *
     * @return JsonResponse
     */
    public function count(): JsonResponse
    {
        try {
            $result = $this->ategencService->getCount();

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
     * Busca agendamento por ID (retorna detalhes completos)
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

                return view('ateagencsearch', [
                    'agendamentos' => [],
                    'error' => 'ID é obrigatório',
                    'searchType' => 'id',
                    'searchValue' => ''
                ]);
            }

            $result = $this->ategencService->getDetalhesById((int) $id);

            if ($request->expectsJson()) {
                if ($result['success']) {
                    return response()->json($result, 200);
                } else {
                    return response()->json($result, 404);
                }
            }

            $agendamentos = $result['success'] && $result['data'] ? [$result['data']] : [];
            $error = $result['success'] ? null : ($result['error'] ?? 'Nenhum agendamento encontrado');

            return view('ateagencsearch', compact('agendamentos', 'error', 'id'))
                ->with('searchType', 'id')
                ->with('searchValue', $id);

        } catch (Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => $e->getMessage()
                ], 500);
            }

            return view('ateagencsearch', [
                'agendamentos' => [],
                'error' => $e->getMessage(),
                'searchType' => 'id',
                'searchValue' => $id ?? ''
            ]);
        }
    }

    /**
     * Busca agendamentos por nome da consulta
     *
     * @param Request $request
     * @param string|null $nome
     * @return View|JsonResponse
     */
    public function searchByNomeConsulta(Request $request, string $nome = null)
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

                return view('ateagencsearch', [
                    'agendamentos' => [],
                    'error' => 'Nome é obrigatório',
                    'searchType' => 'nome-consulta',
                    'searchValue' => ''
                ]);
            }

            $result = $this->ategencService->getAgendamentosByNomeConsulta($nome);

            if ($request->expectsJson()) {
                if ($result['success']) {
                    return response()->json($result, 200);
                } else {
                    return response()->json($result, 404);
                }
            }

            $agendamentos = $result['success'] ? ($result['data'] ?? []) : [];
            $error = $result['success'] ? null : ($result['error'] ?? 'Nenhum agendamento encontrado');

            return view('ateagencsearch', compact('agendamentos', 'error', 'nome'))
                ->with('searchType', 'nome-consulta')
                ->with('searchValue', $nome);

        } catch (Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => $e->getMessage()
                ], 500);
            }

            return view('ateagencsearch', [
                'agendamentos' => [],
                'error' => $e->getMessage(),
                'searchType' => 'nome-consulta',
                'searchValue' => $nome ?? ''
            ]);
        }
    }

    /**
     * Exibe formulário para criar novo agendamento
     *
     * @return View
     */
    public function create(): View
    {
        return view('ateagenccreate');
    }

    /**
     * Salva um novo agendamento
     *
     * @param Request $request
     * @return RedirectResponse|JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $agendamento = $request->except(['_token']);

            $result = $this->ategencService->createAgendamento($agendamento);

            if ($request->expectsJson()) {
                if ($result['success']) {
                    return response()->json($result, 201);
                } else {
                    return response()->json($result, 400);
                }
            }

            if ($result['success']) {
                return redirect()->route('ateagenc.list')
                    ->with('toast_message', 'Agendamento criado com sucesso!')
                    ->with('toast_type', 'success');
            } else {
                return back()
                    ->withInput()
                    ->with('toast_message', $result['error'] ?? 'Erro ao criar agendamento')
                    ->with('toast_type', 'error');
            }

        } catch (Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => $e->getMessage()
                ], 500);
            }

            return back()
                ->withInput()
                ->with('toast_message', 'Erro ao criar agendamento: ' . $e->getMessage())
                ->with('toast_type', 'error');
        }
    }

    /**
     * Exibe formulário para editar agendamento
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $result = $this->ategencService->getDetalhesById($id);

        if (!$result['success'] || empty($result['data'])) {
            return redirect()->route('ateagenc.list')
                ->with('toast_message', 'Agendamento não encontrado')
                ->with('toast_type', 'error');
        }

        $agendamento = $result['data'];

        return view('ateagencedit', compact('agendamento'));
    }

    /**
     * Atualiza um agendamento existente
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request, int $id)
    {
        try {
            $agendamento = $request->except(['_token', '_method']);

            $result = $this->ategencService->updateAgendamento($id, $agendamento);

            if ($request->expectsJson()) {
                if ($result['success']) {
                    return response()->json($result, 200);
                } else {
                    return response()->json($result, 400);
                }
            }

            if ($result['success']) {
                return redirect()->route('ateagenc.list')
                    ->with('toast_message', 'Agendamento atualizado com sucesso!')
                    ->with('toast_type', 'success');
            } else {
                return back()
                    ->withInput()
                    ->with('toast_message', $result['error'] ?? 'Erro ao atualizar agendamento')
                    ->with('toast_type', 'error');
            }

        } catch (Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => $e->getMessage()
                ], 500);
            }

            return back()
                ->withInput()
                ->with('toast_message', 'Erro ao atualizar agendamento: ' . $e->getMessage())
                ->with('toast_type', 'error');
        }
    }

    /**
     * Remove um agendamento
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(Request $request, int $id)
    {
        try {
            $result = $this->ategencService->deleteAgendamento($id);

            if ($request->expectsJson()) {
                if ($result['success']) {
                    return response()->json($result, 200);
                } else {
                    return response()->json($result, 400);
                }
            }

            if ($result['success']) {
                return redirect()->route('ateagenc.list')
                    ->with('toast_message', 'Agendamento removido com sucesso!')
                    ->with('toast_type', 'success');
            } else {
                return redirect()->route('ateagenc.list')
                    ->with('toast_message', $result['error'] ?? 'Erro ao remover agendamento')
                    ->with('toast_type', 'error');
            }

        } catch (Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => $e->getMessage()
                ], 500);
            }

            return redirect()->route('ateagenc.list')
                ->with('toast_message', 'Erro ao remover agendamento: ' . $e->getMessage())
                ->with('toast_type', 'error');
        }
    }

    /**
     * Exibe detalhes de um agendamento
     *
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        $result = $this->ategencService->getDetalhesById($id);

        $agendamento = null;
        $error = null;

        if ($result['success'] && !empty($result['data'])) {
            $agendamento = $result['data'];
        } else {
            $error = $result['error'] ?? 'Agendamento não encontrado';
        }

        return view('ateagenc.detail', compact('agendamento', 'error'));
    }
}
