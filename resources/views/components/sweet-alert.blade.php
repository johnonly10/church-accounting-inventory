@props([
    'entity' => 'null',
])

@once
    @push('styles')
        <style>
            .swal2-popup {
                width: 90vw !important;
                max-width: 600px !important;
                min-height: 350px !important;
                padding: 35px !important;
                border-radius: 16px !important;
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25) !important;
                backdrop-filter: blur(10px) !important;
                background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(248, 250, 252, 0.95)) !important;
            }

            .swal2-title {
                font-size: 24px !important;
                font-weight: 700 !important;
                margin: 0 0 25px 0 !important;
                text-align: center !important;
                line-height: 1.3 !important;
                color: #1e293b !important;
            }

            .swal2-content {
                font-size: 16px !important;
                line-height: 1.6 !important;
                margin: 25px 0 35px 0 !important;
                text-align: center !important;
                color: #475569 !important;
            }

            .swal2-actions {
                margin: 35px 0 0 0 !important;
                gap: 15px !important;
                justify-content: center !important;
            }

            .swal2-confirm,
            .swal2-cancel {
                font-size: 15px !important;
                font-weight: 600 !important;
                padding: 12px 30px !important;
                min-width: 120px !important;
                height: 45px !important;
                border-radius: 8px !important;
                border: none !important;
                cursor: pointer !important;
                transition: all 0.3s ease !important;
            }

            .swal2-confirm {
                background: linear-gradient(135deg, #f59e0b, #d97706) !important;
                color: white !important;
                box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3) !important;
            }

            .swal2-confirm:hover {
                background: linear-gradient(135deg, #d97706, #b45309) !important;
                transform: translateY(-2px) !important;
                box-shadow: 0 6px 20px rgba(245, 158, 11, 0.4) !important;
            }

            .swal2-cancel {
                background: #f8fafc !important;
                color: #64748b !important;
                border: 2px solid #cbd5e1 !important;
            }

            .swal2-cancel:hover {
                background: #e2e8f0 !important;
                border-color: #94a3b8 !important;
                transform: translateY(-1px) !important;
            }

            .swal2-popup::before {
                content: "" !important;
                display: block !important;
                text-align: center !important;
                margin: 20px auto 30px auto !important;
                width: 80px !important;
                height: 80px !important;
                line-height: 80px !important;
                border-radius: 50% !important;
                font-size: 32px !important;
                font-weight: 900 !important;
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
                animation: swalIconPulse 1s ease-in-out !important;
            }

            .swal2-popup.swal2-success::before {
                content: "✓" !important;
                color: #22c55e !important;
                border: 4px solid #22c55e !important;
                background: linear-gradient(135deg, #f0fdf4, #dcfce7) !important;
            }

            .swal2-popup.swal2-error::before {
                content: "✕" !important;
                color: #ef4444 !important;
                border: 4px solid #ef4444 !important;
                background: linear-gradient(135deg, #fef2f2, #fecaca) !important;
            }

            .swal2-popup.swal2-info::before {
                content: "i" !important;
                color: #3b82f6 !important;
                border: 4px solid #3b82f6 !important;
                background: linear-gradient(135deg, #eff6ff, #dbeafe) !important;
                font-style: italic !important;
                font-size: 36px !important;
            }

            .swal2-popup.swal2-question::before {
                content: "?" !important;
                color: #8b5cf6 !important;
                border: 4px solid #8b5cf6 !important;
                background: linear-gradient(135deg, #faf5ff, #ede9fe) !important;
                font-size: 36px !important;
            }

            .swal2-popup.swal2-warning::before {
                content: "!" !important;
                color: #f59e0b !important;
                border: 4px solid #f59e0b !important;
                background: linear-gradient(135deg, #fffbeb, #fef3c7) !important;
                font-size: 36px !important;
            }

            .swal2-icon {
                display: none !important;
            }

            @keyframes swalIconPulse {
                0% {
                    transform: scale(0.8);
                    opacity: 0.5;
                }

                50% {
                    transform: scale(1.05);
                }

                100% {
                    transform: scale(1);
                    opacity: 1;
                }
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            window.SwalKit = (function() {
                const baseConfig = {
                    customClass: {
                        popup: "enhanced-swal-popup",
                        title: "enhanced-swal-title",
                        content: "enhanced-swal-content",
                        actions: "enhanced-swal-actions",
                        confirmButton: "enhanced-swal-confirm",
                        cancelButton: "enhanced-swal-cancel",
                    },
                    buttonsStyling: false,
                    allowOutsideClick: false,
                    allowEscapeKey: true,
                    showCloseButton: true,
                    focusConfirm: false,
                    reverseButtons: true,
                    backdrop: true,
                };

                function fire(options) {
                    return Swal.fire({
                        ...baseConfig,
                        ...options
                    });
                }

                function success(message, opts = {}) {
                    return fire({
                        customClass: {
                            popup: "swal2-success"
                        },
                        title: "Operation Successful!",
                        html: `
                            <div style="text-align: center; line-height: 1.6;">
                                <p style="font-size: 16px; color: #22c55e; margin-bottom: 15px;">
                                    <strong>${message ?? ""}</strong>
                                </p>
                                <div style="background: linear-gradient(135deg, #f0fdf4, #dcfce7); padding: 15px; border-radius: 10px; margin: 20px 0; border-left: 4px solid #22c55e;">
                                    <p style="margin: 0; color: #166534; font-weight: 500;">
                                        <i class="icon-check-circle" style="margin-right: 8px;"></i>
                                        The operation has been completed successfully.
                                    </p>
                                </div>
                                <p style="color: #64748b; font-size: 14px; margin-top: 15px;">
                                    Your changes have been saved and are now active.
                                </p>
                            </div>
                        `,
                        confirmButtonText: '<i class="icon-check"></i> Great!',
                        timer: 5000,
                        timerProgressBar: true,
                        showCloseButton: true,
                        ...opts,
                    });
                }

                function loading(title = "Loading...", subtitle = "Please wait...", opts = {}) {
                    return Swal.fire({
                        title,
                        html: `
                            <div style="text-align: center;">
                                <div style="margin: 20px 0;">
                                    <div class="loading-spinner" style="
                                        width: 40px;
                                        height: 40px;
                                        border: 4px solid #f3f4f6;
                                        border-top: 4px solid #ef4444;
                                        border-radius: 50%;
                                        animation: swalKitSpin 1s linear infinite;
                                        margin: 0 auto 15px auto;
                                    "></div>
                                    <p style="color: #64748b; margin: 0;">${subtitle}</p>
                                </div>
                            </div>
                            <style>
                                @keyframes swalKitSpin {
                                    0% { transform: rotate(0deg); }
                                    100% { transform: rotate(360deg); }
                                }
                            </style>
                        `,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,
                        showCancelButton: false,
                        ...opts,
                    });
                }

                function confirmArchive({
                    entity,
                    name,
                    onConfirm,
                    opts = {}
                }) {
                    return fire({
                        title: `Archive ${entity} Confirmation`,
                        html: `
                            <div style="text-align: left; line-height: 1.6;">
                                <p style="margin-bottom: 15px; text-align: center;">You are about to archive the following ${entity.toLowerCase()}:</p>
                                <div style="background: linear-gradient(135deg, #fffbeb, #fef3c7); padding: 15px; border-radius: 10px; margin: 15px 0; border-left: 4px solid #f59e0b;">
                                    <strong style="color: #92400e; font-size: 16px;">${name ?? ""}</strong>
                                </div>
                                <div style="background: #fef3c7; padding: 12px; border-radius: 8px; margin: 15px 0; border: 1px solid #fcd34d;">
                                    <p style="margin: 0; color: #92400e; font-size: 14px;">
                                        <i class="icon-info" style="margin-right: 8px;"></i>
                                        <strong>Note:</strong> Archiving will move this ${entity.toLowerCase()} to the archived section. It can be restored later if needed.
                                    </p>
                                </div>
                                <p style="margin-top: 20px; color: #64748b; text-align: center;">
                                    This action is reversible. The ${entity.toLowerCase()} will remain in the system but will be hidden from the main list.
                                </p>
                            </div>
                        `,
                        customClass: {
                            popup: "swal2-warning"
                        },
                        showCancelButton: true,
                        confirmButtonColor: "#ef4444",
                        cancelButtonColor: "#6c757d",
                        confirmButtonText: `<i class="icon-trash-2"></i> Yes, Archive It`,
                        cancelButtonText: `<i class="icon-x"></i> Cancel`,
                        focusCancel: true,
                        ...opts,
                    }).then((result) => {
                        if (result.isConfirmed && typeof onConfirm === "function") onConfirm(result);
                        return result;
                    });
                }

                function bindArchive(entity, selector = ".archive", getName, onSubmit) {
                    $(document).on("click", selector, function(e) {
                        e.preventDefault();

                        const $btn = $(this);
                        const form = $btn.closest("form");

                        const name = typeof getName === "function" ?
                            getName($btn) :
                            $btn.closest("tr").find(".name").text().trim();

                        confirmArchive({
                            entity,
                            name,
                            onConfirm: () => {
                                loading(`Archiving ${entity}...`,
                                    `Please wait while we archive the ${entity.toLowerCase()}...`
                                );
                                if (typeof onSubmit === "function") return onSubmit(form, $btn);
                                form.submit();
                            },
                        });
                    });
                }

                return {
                    fire,
                    success,
                    loading,
                    confirmArchive,
                    bindArchive
                };
            })();
        </script>
    @endpush
@endonce

@push('scripts')
    @if (Session::has('success'))
        <script>
            $(function() {
                window.SwalKit.success(@json(Session::get('success')));
            });
        </script>
    @endif

    <script>
        $(function() {
            window.SwalKit.bindArchive(@json($entity));
        });
    </script>
@endpush
