@php
    $breadcrumb = [['title' => __('core::menu.settings'), 'url' => '#'], ['title' => __('core::menu.settings.email'), 'url' => '#', 'active' => true]];
@endphp
@extends('core::layouts.master')

@section('title', "Mail Settings")
@section('content')
    <x-breadcrumb :items="$breadcrumb">
        <div class="h4 mb-0">@lang('core::menu.settings.email')</div>
    </x-breadcrumb>
    <div class="row mb-5">
        <div class="col-md-4 d-none d-md-block">
            <div class="card">
                <div class="card-body">
                    <nav class="nav flex-column nav-pills nav-gap-y-1">
                        <a href="#server" data-bs-toggle="tab" class="nav-item nav-link has-icon nav-link-faded mb-2 active">
                            <i class="fas fa-server icon icon-sm"></i>
                            @lang('core::messages.email.server')
                        </a>
                        <a href="#templates" data-bs-toggle="tab" class="nav-item nav-link has-icon nav-link-faded mb-2">
                            <i class="fas fa-envelope icon icon-sm"></i>
                            @lang('core::messages.email.templates')
                        </a>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header border-bottom mb-3 d-flex d-md-none">
                    <ul class="nav nav-tabs card-header-tabs nav-gap-x-1" role="tablist">
                        <li class="nav-item">
                            <a href="#server" data-bs-toggle="tab" class="nav-link has-icon active"><i class="fas fa-server icon icon-sm"></i></a>
                        </li>
                        <li class="nav-item">
                            <a href="#templates" data-bs-toggle="tab" class="nav-link has-icon"><i class="fas fa-envelop icon icon-sm"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="card-body tab-content">
                    <div class="tab-pane active" id="server">
                        <h6>SERVER</h6>
                        <hr>
                        <x-forms::base-form method="POST" :action="route('admin.settings.email.post')">                   
                            <x-forms::group 
                                mode="select"
                                label="Mailer"
                                name="mail_default" 
                                :required="true"
                            >
                                <option value="smtp" @if(config('mail.default') == 'smtp')selected @endif>SMTP</option>
                                <option value="mailgun" @if(config('mail.default') == 'mailgun')selected @endif>Mailgun</option>
                                <option value="sendmail" @if(config('mail.default') == 'sendmail')selected @endif>Sendmail</option>
                                <option value="postmark" @if(config('mail.default') == 'postmark')selected @endif>Postmark</option>
                                <option value="ses" @if(config('mail.default') == 'ses')selected @endif>SES</option>
                                <option value="log" @if(config('mail.default') == 'log')selected @endif>Log</option>
                                <option value="array" @if(config('mail.default') == 'array')selected @endif>Array</option>
                            </x-forms::group>    
                            <div id="smtp_section">
                                <x-forms::group 
                                    label="Host"
                                    name="mail_mailers_smtp_host" 
                                    placeholder="smtp.gmail.com"
                                    :value="config('mail.mailers.smtp.host')"
                                />                                  
                                <x-forms::group 
                                    type="number"
                                    label="Port"
                                    name="mail_mailers_smtp_port" 
                                    placeholder="587"
                                    :value="config('mail.mailers.smtp.port')"
                                />        
                                <x-forms::group 
                                    mode="select"
                                    label="Encryption"
                                    name="mail_mailers_smtp_encryption" 
                                >
                                    <option value="" @if(config('mail.mailers.smtp.encryption') == null)selected @endif>None</option>
                                    <option value="tls" @if(config('mail.mailers.smtp.encryption') == 'tls')selected @endif>TLS</option>
                                    <option value="ssl" @if(config('mail.mailers.smtp.encryption') == 'ssl')selected @endif>SSL</option>
                                    <option value="starttls" @if(config('mail.mailers.smtp.encryption') == 'starttls')selected @endif>STARTTLS</option>
                                </x-forms::group>                                                           
                                <x-forms::group 
                                    label="Username"
                                    name="mail_mailers_smtp_username" 
                                    placeholder="Enter SMTP username"
                                    :value="config('mail.mailers.smtp.username')"
                                />                                  
                                <x-forms::group
                                    label="Password"
                                    name="mail_mailers_smtp_password" 
                                    placeholder="Enter SMTP password"
                                    :value="config('mail.mailers.smtp.password')"
                                />                                  
                            </div>
                            <div id="sendmail_section" style="display: none">
                                <x-forms::group 
                                    label="Sendmail Path"
                                    name="mail_mailers_sendmail_path" 
                                    help="Default: /usr/sbin/sendmail -bs -i"
                                    :value="config('mail.mailers.sendmail.path')"
                                />                                  
                            </div>
                            <div id="mailgun_section" style="display: none">
                                <x-forms::group 
                                    label="Domain"
                                    name="mail_mailers_mailgun_domain" 
                                    :value="config('mail.mailers.mailgun.domain')"
                                />                                  
                                <x-forms::group 
                                    label="Endpoint"
                                    name="mail_mailers_mailgun_endpoint" 
                                    :value="config('mail.mailers.mailgun.endpoint')"
                                />                                  
                            </div>
                            <div id="log_section" style="display: none">
                                <x-forms::group 
                                    mode="select"
                                    label="Log channel"
                                    name="mail_mailers_log_channel" 
                                    :value="config('mail.mailers.log.channel')"
                                />                                                                  
                            </div>
                            <div id="ses_section" style="display: none">
                                <x-forms::group 
                                    label="Key"
                                    name="mail_mailers_ses_key" 
                                    :value="config('mail.mailers.ses.key')"
                                />                                  
                                <x-forms::group 
                                    label="Endpoint"
                                    name="mail_mailers_ses_region" 
                                    :value="config('mail.mailers.ses.region')"
                                />                                  
                            </div>
                            <x-forms::group 
                                label="Sender Name"
                                name="mail_from_name" 
                                placeholder="John Doe"
                                :value="config('mail.from.name')"
                            />                            
                            <x-forms::group 
                                label="Sender Address"
                                name="mail_from_address" 
                                placeholder="noreply@example.com"
                                :value="config('mail.from.address')"
                            />     
                            <x-forms::group 
                                mode="switch" 
                                name="mail_queue"
                                label="Queue Mode"
                                help="Turn it on if your site have large users (<a href='https://laravel.com/docs/8.x/queues#running-the-queue-worker'>Documentation</a>)."
                                :checked="config('mail.queue', false)"
                            />                                                   
                            <button
                                type="submit"
                                class="btn btn-primary"
                            >
                                @lang('core::messages.save_changes')
                            </button>
                        </x-forms::base-form>        
                    </div>
                    <div class="tab-pane" id="templates">
                        <h6>TEMPLATES</h6>
                        <hr>
                        <ul class="list-group">
                            @foreach(\Email::all() as $name => $data)
                                <li class="list-group-item list-group-item-action border">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="fw-bold">{{ isset($data['title']) ? $data['title'] : $name }}</div>
                                            <small class="text-muted">{{ isset($data['description']) ? $data['description'] : '' }}</small>
                                        </div>
                                        <div>
                                            <button 
                                                type="button" 
                                                class="btn btn-sm btn-warning" 
                                                data-toggle="edit-template-modal" 
                                                data-title="{{ isset($data['title']) ? $data['title'] : $name }}"
                                                data-id="{{$name}}"
                                                @if($data['type'] == 'view')
                                                data-view="{{$data['content']}}"
                                                @endif
                                            >
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                    </div>
                                </li>
                            @endforeach     
                        </ul>                    
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('modal')
<!-- Modal Body -->
<div class="modal fade" id="edit-template-modal" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="templateModalTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <x-email-template-editor name="email_content"></x-email-template-editor>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveTemplate">Save</button>
            </div>
        </div>
    </div>
</div>
@endpush

@push('scripts')
<script>
    function toggleSection(val) {
        const smtp = document.getElementById('smtp_section')
        const sendmail = document.getElementById('sendmail_section')
        const mailgun = document.getElementById('mailgun_section')
        const postmark = document.getElementById('postmark_section')
        const ses = document.getElementById('ses_section')
        const log = document.getElementById('log_section')

        switch(val) {
            case 'smtp':
                smtp.style.display = 'block'
                sendmail.style.display = 'none'
                mailgun.style.display = 'none'
                ses.style.display = 'none'
                log.style.display = 'none'
            break;
            case 'sendmail':
                smtp.style.display = 'none'
                sendmail.style.display = 'block'
                mailgun.style.display = 'none'
                ses.style.display = 'none'
                log.style.display = 'none'
            break;
            case 'mailgun':
                smtp.style.display = 'none'
                sendmail.style.display = 'none'
                mailgun.style.display = 'block'
                ses.style.display = 'none'
                log.style.display = 'none'
            break;
            case 'postmark':
                smtp.style.display = 'none'
                sendmail.style.display = 'none'
                mailgun.style.display = 'none'
                ses.style.display = 'none'
                log.style.display = 'none'
            break;
            case 'ses':
                smtp.style.display = 'none'
                sendmail.style.display = 'none'
                mailgun.style.display = 'none'
                ses.style.display = 'block'
                log.style.display = 'none'
            break;
            case 'log':
                smtp.style.display = 'none'
                sendmail.style.display = 'none'
                mailgun.style.display = 'none'
                ses.style.display = 'none'
                log.style.display = 'block'                
        }
    }

    (function() {
        'use strict';
        
        let   selected_template;
        const mailer  = document.querySelector('select[name="mail_default"]');
        const buttons = document.querySelector('.btn[data-toggle="edit-template-modal"]');

        toggleSection(mailer.value)
        mailer.addEventListener('change', function(e) {
            const { value } = e.target
            toggleSection(value)
        })

        buttons.addEventListener('click', function(e) {
            const id = e.currentTarget.getAttribute('data-id')
            const title = e.currentTarget.getAttribute('data-title')
            const view = e.currentTarget.getAttribute('data-view')

            Utils.toggleLoading({
                el: e.currentTarget,
                loading_text: false,
                callback: function(el, completed) {
                    if(view) {
                        document.querySelector('textarea[name="email_content"]').setAttribute("data-view", view)
                    }

                    selected_template = id
                    const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('edit-template-modal'), {
                        keyboard: false,
                        backdrop: true
                    });

                    document.getElementById('edit-template-modal').addEventListener('shown.bs.modal', function() {
                        window.templateEditor_email_content.codemirror.refresh()
                    })
                    
                    axios.post('{{ route("admin.settings.email.template") }}', {template: id})
                    .then(function({data}) {
                        if(data.success) {
                            window.templateEditor_email_content.value(data.data.content)
                            document.getElementById('templateModalTitle').innerHTML = title
                            modal.show();  
                        } else {
                            Notyf.error(data.message)
                        }          
                    })
                    .finally(function() {
                        completed()
                    })
                }
            })
        })

        document.getElementById('saveTemplate').addEventListener('click', function(e) {
            const content  = window.templateEditor_email_content.value()
            
            Utils.toggleLoading({
                el: e.currentTarget,
                loading_text: false,
                callback: function(el, completed) {
                    axios.post('{{ route("admin.ajax.email-template.update") }}', {content, template: selected_template})
                    .then(function({data}) {
                        if(data.success) {
                            Notyf.success("{{ __('core::messages.saved') }}")
                        } else {
                            Notyf.error(data.message)
                        }
                    })
                    .catch(function(err) {
                        Notyf.error(err)
                    })
                    .finally(function() {
                        completed()
                    })
                }
            })
        })
    })()
</script>
@endpush