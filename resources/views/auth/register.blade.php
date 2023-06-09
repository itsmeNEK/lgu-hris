@extends('layouts.login_reg')

@section('title', 'Register')
@section('content')
    <div class="card w-75 border-0 my-auto mx-auto bg-transparent"
        style="postion:absolute;
top:50%;transform:translateY(-50%)">

        <div class="card-body bg-transparent">
            <h2>Register an Account</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-5">
                    <p class="text-center">
                        Already have an account? <a href="{{ route('login') }}"
                            class="text-decoration-none text-success fw-bold">Login Here!</a>
                    </p>
                </div>
                <div class="row">
                    <label for="first_name" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>

                    <div class="col">
                        <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror"
                            name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                        @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <label for="last_name" class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>

                    <div class="col">
                        <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror"
                            name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                        @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                    <div class="col">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                    <div class="col">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <label for="password-confirm"
                        class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                    <div class="col">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required autocomplete="new-password">
                    </div>
                </div>
                <div class="row justify-content-end mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                        <label class="form-check-label" for="invalidCheck">
                            Agree to
                            <a type="button" class="text-primary" href="#" data-bs-toggle="modal"
                                data-bs-target="#term_condition">
                                Privacy Policy and Terms and Condition
                            </a>.
                        </label>
                        <div class="invalid-feedback">
                            You must agree before submitting.
                        </div>
                    </div>
                </div>

                <div class="row mb-0">
                    <button type="submit" class="btn fw-bold btn-success  w-100">
                        <i class="fa-solid fa-check-to-slot"></i> {{ __('Register') }}
                    </button>
                </div>
            </form>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="privacy_policy" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="exampleModalLabel">Privacy Policy for LGU Delfin Albano</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="term_condition" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="exampleModalLabel">Terms and Conditions of Use</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <h2>1. Terms</h2>

                    <p>By accessing this Website, you are agreeing to be bound by these Website Terms and Conditions of Use
                        and agree that you are responsible for the agreement with any applicable local laws. If you disagree
                        with any of these terms, you are prohibited from accessing this site. The materials contained in
                        this Website are protected by copyright and trade mark law.</p>

                    <h2>2. Use License</h2>

                    <p>Permission is granted to temporarily download one copy of the materials on LGU Delfin Albano's
                        Website for personal, non-commercial transitory viewing only. This is the grant of a license, not a
                        transfer of title, and under this license you may not:</p>

                    <ul>
                        <li>modify or copy the materials;</li>
                        <li>use the materials for any commercial purpose or for any public display;</li>
                        <li>attempt to reverse engineer any software contained on LGU Delfin Albano's Website;</li>
                        <li>remove any copyright or other proprietary notations from the materials; or</li>
                        <li>transferring the materials to another person or "mirror" the materials on any other server.</li>
                    </ul>

                    <p>This will let LGU Delfin Albano to terminate upon violations of any of these restrictions. Upon
                        termination, your viewing right will also be terminated and you should destroy any downloaded
                        materials in your possession whether it is printed or electronic format.</p>

                    <h2>3. Disclaimer</h2>

                    <p>All the materials on LGU Delfin Albano’s Website are provided "as is". LGU Delfin Albano makes no
                        warranties, may it be expressed or implied, therefore negates all other warranties. Furthermore, LGU
                        Delfin Albano does not make any representations concerning the accuracy or reliability of the use of
                        the materials on its Website or otherwise relating to such materials or any sites linked to this
                        Website.</p>

                    <h2>4. Limitations</h2>

                    <p>LGU Delfin Albano or its suppliers will not be hold accountable for any damages that will arise with
                        the use or inability to use the materials on LGU Delfin Albano’s Website, even if LGU Delfin Albano
                        or an authorize representative of this Website has been notified, orally or written, of the
                        possibility of such damage. Some jurisdiction does not allow limitations on implied warranties or
                        limitations of liability for incidental damages, these limitations may not apply to you.</p>

                    <h2>5. Revisions and Errata</h2>

                    <p>The materials appearing on LGU Delfin Albano’s Website may include technical, typographical, or
                        photographic errors. LGU Delfin Albano will not promise that any of the materials in this Website
                        are accurate, complete, or current. LGU Delfin Albano may change the materials contained on its
                        Website at any time without notice. LGU Delfin Albano does not make any commitment to update the
                        materials.</p>

                    <h2>6. Links</h2>

                    <p>LGU Delfin Albano has not reviewed all of the sites linked to its Website and is not responsible for
                        the contents of any such linked site. The presence of any link does not imply endorsement by LGU
                        Delfin Albano of the site. The use of any linked website is at the user’s own risk.</p>

                    <h2>7. Site Terms of Use Modifications</h2>

                    <p>LGU Delfin Albano may revise these Terms of Use for its Website at any time without prior notice. By
                        using this Website, you are agreeing to be bound by the current version of these Terms and
                        Conditions of Use.</p>

                    <h2>8. Your Privacy</h2>


                    <p>At HRIS - LGU Delfin Albano, one of our main
                        priorities is the privacy of our visitors. This Privacy Policy document contains types of
                        information that is collected and recorded by HRIS - LGU Delfin Albano and how we use it.</p>

                    <p>If you have additional questions or require more information about our Privacy Policy, do not
                        hesitate to contact us.</p>

                    <p>This Privacy Policy applies only to our online activities and is valid for visitors to our website
                        with regards to the information that they shared and/or collect in HRIS - LGU Delfin Albano. This
                        policy is not applicable to any information collected offline or via channels other than this
                        website.</p>

                    <h2>Consent</h2>

                    <p>By using our website, you hereby consent to our Privacy Policy and agree to its terms.</p>

                    <h2>Information we collect</h2>

                    <p>The personal information that you are asked to provide, and the reasons why you are asked to provide
                        it, will be made clear to you at the point we ask you to provide your personal information.</p>
                    <p>If you contact us directly, we may receive additional information about you such as your name, email
                        address, phone number, the contents of the message and/or attachments you may send us, and any other
                        information you may choose to provide.</p>
                    <p>When you register for an Account, we may ask for your contact information, including items such as
                        name, company name, address, email address, and telephone number.</p>

                    <h2>How we use your information</h2>

                    <p>We use the information we collect in various ways, including to:</p>

                    <ul>
                        <li>Provide, operate, and maintain our website</li>
                        <li>Improve, personalize, and expand our website</li>
                        <li>Understand and analyze how you use our website</li>
                        <li>Develop new products, services, features, and functionality</li>
                        <li>Communicate with you, either directly or through one of our partners, including for customer
                            service, to provide you with updates and other information relating to the website, and for
                            marketing and promotional purposes</li>
                        <li>Send you emails</li>
                        <li>Find and prevent fraud</li>
                    </ul>

                    <h2>Log Files</h2>

                    <p>HRIS - LGU Delfin Albano follows a standard procedure of using log files. These files log visitors
                        when they visit websites. All hosting companies do this and a part of hosting services' analytics.
                        The information collected by log files include internet protocol (IP) addresses, browser type,
                        Internet Service Provider (ISP), date and time stamp, referring/exit pages, and possibly the number
                        of clicks. These are not linked to any information that is personally identifiable. The purpose of
                        the information is for analyzing trends, administering the site, tracking users' movement on the
                        website, and gathering demographic information.</p>

                    <h2>Cookies and Web Beacons</h2>

                    <p>Like any other website, HRIS - LGU Delfin Albano uses 'cookies'. These cookies are used to store
                        information including visitors' preferences, and the pages on the website that the visitor accessed
                        or visited. The information is used to optimize the users' experience by customizing our web page
                        content based on visitors' browser type and/or other information.</p>



                    <h2>Advertising Partners Privacy Policies</h2>

                    <P>You may consult this list to find the Privacy Policy for each of the advertising partners of HRIS -
                        LGU Delfin Albano.</p>

                    <p>Third-party ad servers or ad networks uses technologies like cookies, JavaScript, or Web Beacons that
                        are used in their respective advertisements and links that appear on HRIS - LGU Delfin Albano, which
                        are sent directly to users' browser. They automatically receive your IP address when this occurs.
                        These technologies are used to measure the effectiveness of their advertising campaigns and/or to
                        personalize the advertising content that you see on websites that you visit.</p>

                    <p>Note that HRIS - LGU Delfin Albano has no access to or control over these cookies that are used by
                        third-party advertisers.</p>

                    <h2>Third Party Privacy Policies</h2>

                    <p>HRIS - LGU Delfin Albano's Privacy Policy does not apply to other advertisers or websites. Thus, we
                        are advising you to consult the respective Privacy Policies of these third-party ad servers for more
                        detailed information. It may include their practices and instructions about how to opt-out of
                        certain options. </p>

                    <p>You can choose to disable cookies through your individual browser options. To know more detailed
                        information about cookie management with specific web browsers, it can be found at the browsers'
                        respective websites.</p>

                    <h2>CCPA Privacy Rights (Do Not Sell My Personal Information)</h2>

                    <p>Request that a business that collects a consumer's personal data disclose the categories and specific
                        pieces of personal data that a business has collected about consumers.</p>
                    <p>Request that a business delete any personal data about the consumer that a business has collected.
                    </p>
                    <p>Request that a business that sells a consumer's personal data, not sell the consumer's personal data.
                    </p>
                    <p>If you make a request, we have one month to respond to you. If you would like to exercise any of
                        these rights, please contact us.</p>

                    <h2>GDPR Data Protection Rights</h2>

                    <p>We would like to make sure you are fully aware of all of your data protection rights. Every user is
                        entitled to the following:</p>
                    <p>The right to access – You have the right to request copies of your personal data. We may charge you a
                        small fee for this service.</p>
                    <p>The right to rectification – You have the right to request that we correct any information you
                        believe is inaccurate. You also have the right to request that we complete the information you
                        believe is incomplete.</p>
                    <p>The right to erasure – You have the right to request that we erase your personal data, under certain
                        conditions.</p>
                    <p>The right to restrict processing – You have the right to request that we restrict the processing of
                        your personal data, under certain conditions.</p>
                    <p>The right to object to processing – You have the right to object to our processing of your personal
                        data, under certain conditions.</p>
                    <p>The right to data portability – You have the right to request that we transfer the data that we have
                        collected to another organization, or directly to you, under certain conditions.</p>
                    <p>If you make a request, we have one month to respond to you. If you would like to exercise any of
                        these rights, please contact us.</p>


                    <h2>9. Governing Law</h2>

                    <p>Any claim related to LGU Delfin Albano's Website shall be governed by the laws of ph without regards
                        to its conflict of law provisions.</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
