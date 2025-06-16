<div class="row p-2 justify-content-center">
    <div class="bs-stepper wizard-numbered mt-2">
        <div class="bs-stepper-header">
            <div class="row">
                <div class="col">
                    <a href="{{ route('profile.create') }}">
                        <div class="step {{ request()->routeIs('profile.create') ? 'border rounded' : '' }}" data-target="#account-details">
                            <button type="button" class="step-trigger">
                                <span class="bs-stepper-circle {{ request()->routeIs('profile.create') ? 'bg-secondary' : '' }}">1</span>
                                <span class="bs-stepper-label">
                                <span class="bs-stepper-title">PERSONAL INFORMATION</span>
                                <span class="bs-stepper-subtitle">Setup Personal Information</span>
                                </span>
                            </button>
                        </div>
                    </a>
                    <div class="line">
                        <i class="icon-base ti tabler-chevron-right"></i>
                    </div>
                </div>

                <div class="col">
                    <a href="{{ route('contact-information.create') }}">
                        <div class="step {{ request()->routeIs('contact-information.create') ? 'border rounded' : '' }}" data-target="#personal-info">
                            <button type="button" class="step-trigger">
                                <span class="bs-stepper-circle {{ request()->routeIs('contact-information.create') ? 'bg-secondary' : '' }}">2</span>
                                <span class="bs-stepper-label">
                                <span class="bs-stepper-title">CONTACT INFORMATION</span>
                                <span class="bs-stepper-subtitle">Add contact information</span>
                                </span>
                            </button>
                        </div>
                    </a>
                    <div class="line">
                        <i class="icon-base ti tabler-chevron-right"></i>
                    </div>
                </div>

                <div class="col">
                    <a href="{{ route('academic-qualification.create') }}">
                        <div class="step {{ request()->routeIs('academic-qualification.create') ? 'border rounded' : '' }}" data-target="#social-links">
                            <button type="button" class="step-trigger">
                                <span class="bs-stepper-circle {{ request()->routeIs('academic-qualification.create') ? 'bg-secondary' : '' }}">3</span>
                                <span class="bs-stepper-label">
                                <span class="bs-stepper-title">ACADEMIC QUALIFICATIONS</span>
                                <span class="bs-stepper-subtitle">Add academic qualifications</span>
                                </span>
                            </button>
                        </div>
                    </a>

                    <div class="line">
                        <i class="icon-base ti tabler-chevron-right"></i>
                    </div>
                </div>

                <div class="col">
                    <a href="{{ route('professional-affiliation.create') }}">
                    <div class="step {{ request()->routeIs('professional-affiliation.create') ? 'border rounded' : '' }}" data-target="#social-links">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-circle {{ request()->routeIs('professional-affiliation.create') ? 'bg-secondary' : '' }}">4</span>
                            <span class="bs-stepper-label">
                            <span class="bs-stepper-title">PROFESSIONAL AFFILIATIONS</span>
                            <span class="bs-stepper-subtitle">Add professional affiliations</span>
                            </span>
                        </button>
                    </div>
                    </a>

                    <div class="line">
                        <i class="icon-base ti tabler-chevron-right"></i>
                    </div>
                </div>

                {{-- <div class="col">
                    <div class="step" data-target="#social-links">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-circle">5</span>
                            <span class="bs-stepper-label">
                            <span class="bs-stepper-title">MEMBERSHIP CATEGORY</span>
                            <span class="bs-stepper-subtitle">Add membership category</span>
                            </span>
                        </button>
                    </div>

                    <div class="line">
                        <i class="icon-base ti tabler-chevron-right"></i>
                    </div>
                </div> --}}

                <div class="col">
                    <a href="{{ route('document.create') }}">
                    <div class="step  {{ request()->routeIs('document.create') ? 'border rounded' : '' }}" data-target="#social-links">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-circle {{ request()->routeIs('document.create') ? 'bg-secondary' : '' }}">5</span>
                            <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Document</span>
                            <span class="bs-stepper-subtitle">Add document</span>
                            </span>
                        </button>
                    </div>
                    </a>
                </div>


            </div>
        </div>

    </div>
</div>
