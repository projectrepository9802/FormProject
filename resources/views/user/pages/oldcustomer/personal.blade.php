@extends('user.layouts.main')

@section('CSS')
    <!-- Smart Wizard -->
    <link href="{{ URL::to('lib/jquery-smartwizard/dist/css/smart_wizard_dots.min.css') }}" rel="stylesheet"
        type="text/css" />
@endsection

@section('content-wrapper')
    <div class="container p-5">
        <div class="card mx-5">
            <div class="card-body">
                <h2 class="text-center fw-bold mt-2 mb-4">Form Registrasi Layanan Baru</h2>
                <!-- SmartWizard html -->
                <form action="{{ URL::to('old-member/personal') }}" method="POST" id="personalForm"
                    enctype="multipart/form-data">
                    @csrf
                    <div id="smartwizard">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#personal-info">
                                    <div class="num"><i class="fa-solid fa-user"></i></div>
                                    Data Personal
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#billing-info">
                                    <span class="num"><i class="fa-solid fa-money-bill-wave"></i></span>
                                    Data Billing
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#technical-info">
                                    <span class="num"><i class="fa-solid fa-list-check"></i></span>
                                    Data Teknis
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#terms-info">
                                    <span class="num"><i class="fas fa-scroll"></i></span>
                                    Syarat & Ketentuan
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div id="personal-info" class="tab-pane" role="tabpanel" aria-labelledby="personal-info">
                                <div class="container row">
                                    <div class="col-sm-6">
                                        <input type="hidden" name="uuid" value="{{ Request::segment(3) }}">
                                        <div class="mb-3">
                                            <label for="personal_name" class="form-label">Nama
                                                Lengkap <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('personal_name') is-invalid @enderror"
                                                id="personal_name" name="personal_name"
                                                placeholder="Masukkan Nama Lengkap Anda..."
                                                value="{{ old('personal_name', $oldCustData->name) }}" readonly>
                                            @error('personal_name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="identity_personal_number" class="form-label">Nomor Identitas
                                                (KTP/SIM/KITAS) <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('identity_personal_number') is-invalid @enderror"
                                                id="identity_personal_number" name="identity_personal_number"
                                                placeholder="Masukkan Nomor Identitas Anda..."
                                                value="{{ old('identity_personal_number', $oldCustData->identity_number) }}"
                                                readonly>
                                            @error('identity_personal_number')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="email_address" class="form-label">Alamat Email
                                                <span class="text-danger">*</span></label>
                                            <input type="email"
                                                class="form-control @error('email_address') is-invalid @enderror"
                                                id="email_address" name="email_address"
                                                placeholder="Masukkan Alamat E-Mail Anda..."
                                                value="{{ old('email_address', $oldCustData->email) }}" readonly>
                                            @error('email_address')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="personal_address" class="form-label">Alamat Lengkap <span
                                                    class="text-danger">*</span></label>
                                            <textarea class="form-control @error('personal_address') is-invalid @enderror" id="personal_address"
                                                name="personal_address" rows="8" placeholder="Masukkan Alamat Lengkap Anda..." readonly>{{ old('personal_address', $oldCustData->address) }}</textarea>
                                            @error('personal_address')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="billing-info" class="tab-pane" role="tabpanel" aria-labelledby="billing-info">
                                <div class="container row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="billing_name" class="form-label">Nama
                                                Biller <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('billing_name') is-invalid @enderror"
                                                id="billing_name" name="billing_name"
                                                placeholder="Masukkan Nama Lengkap Anda..."
                                                value="{{ old('billing_name', $oldCustData->billing->billing_name) }}"
                                                readonly>
                                            @error('billing-info')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="billing_phone" class="form-label">Nomor Handphone
                                                <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('billing_phone') is-invalid @enderror"
                                                id="billing_phone" name="billing_phone"
                                                placeholder="Masukkan Nomor Handphone Anda..."
                                                value="{{ old('billing_phone', $oldCustData->billing->billing_contact) }}"
                                                readonly>
                                            @error('billing_phone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="billing_email" class="form-label">Alamat Email
                                                <span class="text-danger">*</span></label>
                                            <input type="email"
                                                class="form-control @error('billing_email') is-invalid @enderror"
                                                id="billing_email" name="billing_email"
                                                placeholder="Masukkan Alamat E-Mail Anda..."
                                                value="{{ old('billing_email', $oldCustData->billing->billing_email) }}"
                                                readonly>
                                            @error('billing_email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="technical-info" class="tab-pane" role="tabpanel" aria-labelledby="technical-info">
                                <div class="mb-3">
                                    <label for="technical_service" class="form-label">Pilihan Layanan
                                        <span class="text-danger">*</span>
                                    </label>
                                    @php
                                        $servicesData = ['Dedicated Fiber Optic', 'Dedicated Wireless', 'Broadband Fiber Optic', 'Broadband Wireless'];
                                    @endphp
                                    <select class="form-select @error('technical_service') is-invalid @enderror"
                                        name="technical_service" id="technical_service" disabled>
                                        <option disabled selected>Pilih Jenis Layanan...</option>
                                        @foreach ($servicesData as $service)
                                            @if (old('technical_service', $oldCustData->technical->service_package) == $service)
                                                <option value="{{ $service }}" selected>{{ $service }}</option>
                                            @else
                                                <option value="{{ $service }}">{{ $service }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('technical-info')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button class="btn btn-success mb-3" type="button" id="addServiceforPersonal">
                                    <i class="fas fa-plus me-1"></i>
                                    Tambah Layanan
                                </button>
                            </div>
                            <div id="terms-info" class="tab-pane" role="tabpanel" aria-labelledby="terms-info">
                                <iframe
                                    src="https://docs.google.com/document/d/e/2PACX-1vTj32yhGrASZFiwRmOEs4ZudnKnSn3vUxST3rgx96ox7LVCS-7wR-DXmoAC9TuQBZU00TcBTgP5WFz6/pub?embedded=true"
                                    style="width: 100%; height: 500px;"></iframe>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="termsCbo" name="termsCbo">
                                    <label class="form-check-label" for="termsCbo">Saya menyetujui syarat dan
                                        ketentuan yang berlaku</label>
                                </div>
                            </div>
                        </div>

                        <!-- Include optional progressbar HTML -->
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('JS')
    <!-- Bootstrap 5.1 -->
    <script src="{{ URL::to('lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Smart Wizard -->
    <script src="{{ URL::to('lib/jquery-smartwizard/dist/js/jquery.smartWizard.min.js') }}" type="text/javascript">
    </script>
    <!-- PDF Viewer -->
    <script src="{{ URL::to('lib/pdfviewer/pspdfkit.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#smartwizard').smartWizard({
                selected: 0, // Initial selected step, 0 = first step
                theme: 'dots', // theme for the wizard, related css need to include for other than default theme
                justified: true, // Nav menu justification. true/false
                autoAdjustHeight: true, // Automatically adjust content height
                backButtonSupport: true, // Enable the back button support
                enableUrlHash: true, // Enable selection of the step based on url hash
                transition: {
                    animation: 'fade', // Animation effect on navigation, none|fade|slideHorizontal|slideVertical|slideSwing|css(Animation CSS class also need to specify)
                    speed: '400', // Animation speed. Not used if animation is 'css'
                },
                toolbar: {
                    position: 'bottom', // none|top|bottom|both
                    showNextButton: true, // show/hide a Next button
                    showPreviousButton: true, // show/hide a Previous button
                    extraHtml: '<button class="btn btn-success" id="btnSubmitPersonalForms" type="button"><i class="fas fa-save me-1"></i> Submit Form</button>' // Extra html to show on toolbar
                },
                anchor: {
                    enableNavigation: true, // Enable/Disable anchor navigation
                    enableNavigationAlways: false, // Activates all anchors clickable always
                    enableDoneState: true, // Add done state on visited steps
                    markPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
                    unDoneOnBackNavigation: true, // While navigate back, done state will be cleared
                    enableDoneStateNavigation: true // Enable/Disable the done state navigation
                },
                keyboard: {
                    keyNavigation: true, // Enable/Disable keyboard navigation(left and right keys are used if enabled)
                    keyLeft: [37], // Left key code
                    keyRight: [39] // Right key code
                },
                lang: { // Language variables for button
                    next: 'Selanjutnya >>',
                    previous: '<< Sebelumnya'
                },
                disabledSteps: [], // Array Steps disabled
                errorSteps: [], // Array Steps error
                warningSteps: [], // Array Steps warning
                hiddenSteps: [], // Hidden steps
                getContent: null // Callback function for content loading
            });

            $("#btnSubmitPersonalForms").toggle(false);

            $('#termsCbo').click(function() {
                $("#btnSubmitPersonalForms").toggle(this.checked);
            });

            setInputFilter(document.getElementById("identity_personal_number"), function(value) {
                return /^\d*\.?\d*$/.test(value); // Allow digits and '.' only, using a RegExp
            }, "Nomor Identitas harus berupa angka");
            setInputFilter(document.getElementById("billing_phone"), function(value) {
                return /^\d*\.?\d*$/.test(value); // Allow digits and '.' only, using a RegExp
            }, "Nomor Handphone harus berupa angka");

            $("#btnSubmitPersonalForms").on('click', () => {
                $("#personalForm").trigger('submit');
            })

            $("#addServiceforPersonal").on('click', () => {
                alert("Testing Button Add");
            })

        });

        function setInputFilter(textbox, inputFilter, errMsg) {
            ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop", "focusout"]
            .forEach(function(event) {
                textbox.addEventListener(event, function(e) {
                    if (inputFilter(this.value)) {
                        // Accepted value
                        if (["keydown", "mousedown", "focusout"].indexOf(e.type) >= 0) {
                            this.classList.remove("input-error");
                            this.setCustomValidity("");
                        }
                        this.oldValue = this.value;
                        this.oldSelectionStart = this.selectionStart;
                        this.oldSelectionEnd = this.selectionEnd;
                    } else if (this.hasOwnProperty("oldValue")) {
                        // Rejected value - restore the previous one
                        this.classList.add("input-error");
                        this.setCustomValidity(errMsg);
                        this.reportValidity();
                        this.value = this.oldValue;
                        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                    } else {
                        // Rejected value - nothing to restore
                        this.value = "";
                    }
                });
            });
        }
    </script>
@endsection
