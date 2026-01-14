<x-layout title='Home'>
    <!-- Body Content Wrapper -->

    <div class="ms-content-wrapper">
       
            <div class="row">

                <div class="col-xl-3 col-md-6 col-sm-6">
                    <div class="ms-card card-gradient-custom ms-widget ms-infographics-widget ms-p-relative">
                        <div class="ms-card-body media">
                            <div class="media-body">
                                <h6>Canal de Atendimento</h6>
                                @if(isset($channel) && $channel)
                                    <p class="mb-1">{{ $channel->channelName }}</p>
                                    @if(!is_null($channelActive))
                                        @if($channelActive === true)
                                            <span class="badge badge-success">Status: Ativo</span>
                                        @else
                                            <span class="badge badge-danger">Status: Inativo</span>
                                        @endif
                                    @elseif(!empty($channelStatus))
                                        <span class="badge badge-secondary">Status: {{ $channelStatus }}</span>
                                    @elseif(!empty($channelError))
                                        <span class="badge badge-danger">Status: {{ $channelError }}</span>
                                    @else
                                        <span class="badge badge-secondary">Status: Desconhecido</span>
                                    @endif
                                @else
                                    <span class="badge badge-warning">Nenhum canal configurado</span>
                                @endif
                            </div>
                        </div>
                        <i class="fas fa-headset ms-icon-mr"></i>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-sm-6">
                    <a href="#">
                        <div class="ms-card card-gradient-custom ms-widget ms-infographics-widget ms-p-relative">
                            <div class="ms-card-body media">
                                <div class="media-body">
                                    <h6>Agendamentos</h6>
                                    <p class="ms-card-change"> 25035</p>
                                </div>
                            </div>
                            <i class="fas fa-user-plus ms-icon-mr"></i>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3 col-md-6 col-sm-6">
                    <a href="#">
                        <div class="ms-card card-gradient-custom ms-widget ms-infographics-widget ms-p-relative">
                            <div class="ms-card-body media">
                                <div class="media-body">
                                    <h6 class="bold">Titulares</h6>
                                    <p class="ms-card-change"> 50000</p>
                                </div>
                            </div>
                            <i class="fa fa-wheelchair ms-icon-mr"></i>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3 col-md-6 col-sm-6">
                    <a href="">
                        <div class="ms-card card-gradient-custom ms-widget ms-infographics-widget ms-p-relative">
                            <div class="ms-card-body media">
                                <div class="media-body">
                                    <h6 class="bold">Dependentes</h6>
                                    <p class="ms-card-change">120500 </p>
                                </div>
                            </div>
                            <i class="fas fa-briefcase-medical ms-icon-mr"></i>
                        </div>
                    </a>
                </div>
            </div>

    </div>
</x-layout>