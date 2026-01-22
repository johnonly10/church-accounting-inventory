@props([
    'title' => null,
    'createRoute' => null,
    'archiveRoute' => null,
    'createLabel' => 'Add New',
    'archiveLabel' => 'Archive',
    'homeRoute' => null,
    'homeLabel' => '',
    'showFilters' => false,
    'filterProps' => [],
])

<div class="row">
    <div class="col-lg-12">
        <div {{ $attributes->merge(['class' => 'white_card card_height_100 mb_30']) }}>
            <div class="white_card_header">
                <!-- Action Buttons Row - Now on top for better mobile experience -->
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="d-flex justify-content-end gap-2 button-group-enhanced">
                            @if ($createRoute)
                                <a href="{{ $createRoute }}" class="btn_1 btn-enhanced">
                                    <i class="fas fa-plus icon-enhanced"></i>
                                    <span class="btn-text">{{ $createLabel }} {{ $title }}</span>
                                </a>
                            @endif

                            @if ($homeRoute)
                                <a href="{{ $homeRoute }}" class="btn_1 btn-enhanced">
                                    <i class="fas fa-arrow-left"></i>
                                    <span class="btn-text">{{ $homeLabel }} {{ $title }}</span>
                                </a>
                            @endif
                            @if ($archiveRoute)
                                <a href="{{ $archiveRoute }}" class="btn_1 gray_btn btn-enhanced">
                                    <i class="fas fa-archive icon-enhanced"></i>
                                    <span class="btn-text">{{ $archiveLabel }} {{ $title }}</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Filters Row - Now below buttons -->
                @if ($showFilters)
                    <div class="row">
                        <div class="col-12">
                            <x-white-card-filters :searchPlaceholder="$filterProps['searchPlaceholder'] ?? ''" :searchName="$filterProps['searchName'] ?? 'search'" :searchValue="$filterProps['searchValue'] ?? request()->get('search', '')"
                                :dateFromLabel="$filterProps['dateFromLabel'] ?? null" :dateFromName="$filterProps['dateFromName'] ?? 'date_from'" :dateFromValue="$filterProps['dateFromValue'] ?? request()->get('date_from', '')" :dateToLabel="$filterProps['dateToLabel'] ?? null"
                                :dateToName="$filterProps['dateToName'] ?? 'date_to'" :dateToValue="$filterProps['dateToValue'] ?? request()->get('date_to', '')" :filter1Label="$filterProps['filter1Label'] ?? null" :filter1Name="$filterProps['filter1Name'] ?? 'filter1'"
                                :filter1Value="$filterProps['filter1Value'] ?? request()->get('filter1', '')" :filter1Options="$filterProps['filter1Options'] ?? []" :filter2Label="$filterProps['filter2Label'] ?? null" :filter2Name="$filterProps['filter2Name'] ?? 'filter2'"
                                :filter2Value="$filterProps['filter2Value'] ?? request()->get('filter2', '')" :filter2Options="$filterProps['filter2Options'] ?? []" :filter3Label="$filterProps['filter3Label'] ?? null" :filter3Name="$filterProps['filter3Name'] ?? 'filter3'"
                                :filter3Value="$filterProps['filter3Value'] ?? request()->get('filter3', '')" :filter3Options="$filterProps['filter3Options'] ?? []" :filter4Label="$filterProps['filter4Label'] ?? null" :filter4Name="$filterProps['filter4Name'] ?? 'filter4'"
                                :filter4Value="$filterProps['filter4Value'] ?? request()->get('filter4', '')" :filter4Options="$filterProps['filter4Options'] ?? []" resultsContainerId="ajax-results-container" />
                        </div>
                    </div>
                @endif
            </div>
            <div class="white_card_body card-body-enhanced">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>

<style>
    .button-group-enhanced {
        gap: 0.75rem !important;
        flex-wrap: wrap;
    }

    .btn-enhanced {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.625rem 1.25rem;
        font-weight: 500;
        font-size: 0.9375rem;
        border-radius: 0.5rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
        position: relative;
        overflow: hidden;
        white-space: nowrap;
        min-width: fit-content;
    }

    .btn-enhanced:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
    }

    .btn-enhanced:active {
        transform: translateY(0);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
    }

    .icon-enhanced {
        font-size: 0.875rem;
        transition: transform 0.3s ease;
    }

    .btn-enhanced:hover .icon-enhanced {
        transform: scale(1.1);
    }

    .btn-text {
        position: relative;
        z-index: 1;
    }

    .btn-enhanced::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.15);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }

    .btn-enhanced:hover::before {
        width: 300px;
        height: 300px;
    }

    .card-body-enhanced {
        transition: all 0.3s ease;
    }

    /* Tablet and below */
    @media (max-width: 991px) {
        .button-group-enhanced {
            justify-content: flex-start !important;
        }
    }

    /* Mobile */
    @media (max-width: 576px) {
        .button-group-enhanced {
            flex-direction: column;
            align-items: stretch;
        }

        .btn-enhanced {
            justify-content: center;
            width: 100%;
        }

        .btn-text {
            font-size: 0.875rem;
        }
    }

    .btn-enhanced:focus {
        outline: 2px solid currentColor;
        outline-offset: 2px;
    }

    .white_card {
        transition: box-shadow 0.3s ease;
    }

    .white_card:hover {
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
    }

    .white_card_header {
        padding: 1.5rem;
    }

    .white_card_header .mb-3:last-child {
        margin-bottom: 0 !important;
    }
</style>
