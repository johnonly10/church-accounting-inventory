// // resources/js/revenues/revenue-form.js

// import $ from "jquery";

// $(document).ready(function () {
//     const $form = $("#revenueForm");
//     if (!$form.length) return;

//     const $actionBtn =
//         $("#createRevenueBtn").length ? $("#createRevenueBtn") :
//         $("#updateRevenueBtn").length ? $("#updateRevenueBtn") :
//         $();

//     const isCreateMode = $("#add-revenue").length > 0 || $('[name^="revenues["]').length > 0;

//     const phpCurrency = new Intl.NumberFormat("en-PH", {
//         style: "currency",
//         currency: "PHP",
//         minimumFractionDigits: 2,
//         maximumFractionDigits: 2,
//     });

//     const intFormatter = new Intl.NumberFormat("en-US", {
//         maximumFractionDigits: 0,
//     });

//     function fmtPHP(n) {
//         return phpCurrency.format(Number(n) || 0);
//     }

//     function cleanIntString(v) {
//         return String(v ?? "").replace(/[^\d]/g, "");
//     }

//     function toInt(v) {
//         const s = cleanIntString(v);
//         const n = parseInt(s, 10);
//         return Number.isFinite(n) ? n : 0;
//     }

//     function fmtInt(v) {
//         return intFormatter.format(toInt(v));
//     }

//     function findCalcEl($input) {
//         // create page: inside .denomination-input-wrapper
//         const $w = $input.closest(".denomination-input-wrapper");
//         if ($w.length) return $w.find(".denomination-calc");

//         // edit page: calc is usually a sibling in the same container
//         const $sib = $input.siblings(".denomination-calc");
//         if ($sib.length) return $sib;

//         return $input.parent().find(".denomination-calc");
//     }

//     function setActionBtnDisabled(disabled) {
//         if (!$actionBtn.length) return;

//         $actionBtn.prop("disabled", disabled);
//         $actionBtn
//             .attr("aria-disabled", disabled ? "true" : "false")
//             .toggleClass("disabled", disabled);

//         $actionBtn.css(disabled ? { pointerEvents: "none", opacity: 0.6 } : { pointerEvents: "", opacity: "" });
//     }

//     function toggleCashBreakdown($card) {
//         const method = $card.find(".payment-method-select").val();
//         const $cashSection = $card.find(".cash-breakdown-section");

//         if (method === "cash") {
//             $cashSection.addClass("active");
//         } else {
//             $cashSection.removeClass("active");
//             $card.find(".validation-message").hide().removeClass("warning error success");
//         }
//     }

//     function getBreakdownTotal($card) {
//         let billsTotal = 0;
//         let coinsTotal = 0;
//         let centimosTotal = 0;

//         $card.find(".cash-breakdown-section .denomination-input").each(function () {
//             const $input = $(this);
//             const count = toInt($input.val());
//             const value = Number($input.data("value")) || 0;
//             const total = count * value;

//             const name = $input.attr("name") || "";
//             if (name.includes("bill_")) billsTotal += total;
//             else if (name.includes("coin_")) coinsTotal += total;
//             else if (name.includes("centimo_")) centimosTotal += total;
//         });

//         return billsTotal + coinsTotal + centimosTotal;
//     }

//     function validateCashBreakdown($card, breakdownTotal) {
//         const method = $card.find(".payment-method-select").val();
//         const $msg = $card.find(".validation-message");

//         if (method !== "cash") {
//             $msg.hide().removeClass("warning error success");
//             $card.data("cash-valid", true);
//             return true;
//         }

//         const revenueAmount = Number($card.find(".revenue-amount").val()) || 0;
//         const diff = Math.abs(revenueAmount - breakdownTotal);
//         const valid = diff < 0.01;

//         $msg.removeClass("warning error success");

//         if (valid) {
//             $msg.addClass("success")
//                 .html('<i class="fas fa-check-circle"></i> Cash breakdown matches the revenue amount perfectly!')
//                 .show();
//         } else if (breakdownTotal > revenueAmount) {
//             $msg.addClass("error")
//                 .html(
//                     '<i class="fas fa-exclamation-circle"></i> Cash breakdown (' +
//                         fmtPHP(breakdownTotal) +
//                         ") exceeds revenue amount (" +
//                         fmtPHP(revenueAmount) +
//                         ") by " +
//                         fmtPHP(diff)
//                 )
//                 .show();
//         } else {
//             $msg.addClass("warning")
//                 .html(
//                     '<i class="fas fa-exclamation-triangle"></i> Cash breakdown (' +
//                         fmtPHP(breakdownTotal) +
//                         ") is less than revenue amount (" +
//                         fmtPHP(revenueAmount) +
//                         ") by " +
//                         fmtPHP(diff)
//                 )
//                 .show();
//         }

//         $card.data("cash-valid", valid);
//         return valid;
//     }

//     function calculateDenominationTotals($card) {
//         const $section = $card.find(".cash-breakdown-section");
//         if (!$section.length) return 0;

//         let billsTotal = 0;
//         let coinsTotal = 0;
//         let centimosTotal = 0;

//         $section.find(".denomination-input").each(function () {
//             const $input = $(this);
//             const count = toInt($input.val());
//             const value = Number($input.data("value")) || 0;
//             const total = count * value;

//             findCalcEl($input).text("= " + fmtPHP(total));

//             const name = $input.attr("name") || "";
//             if (name.includes("bill_")) billsTotal += total;
//             else if (name.includes("coin_")) coinsTotal += total;
//             else if (name.includes("centimo_")) centimosTotal += total;
//         });

//         const grandTotal = billsTotal + coinsTotal + centimosTotal;

//         $section.find(".bills-total").text(fmtPHP(billsTotal));
//         $section.find(".coins-total").text(fmtPHP(coinsTotal));
//         $section.find(".centimos-total").text(fmtPHP(centimosTotal));
//         $section.find(".grand-total-value").text(fmtPHP(grandTotal));

//         validateCashBreakdown($card, grandTotal);

//         return grandTotal;
//     }

//     function isCardValid($card) {
//         const method = $card.find(".payment-method-select").val();
//         if (method !== "cash") return true;

//         const revenueAmount = Number($card.find(".revenue-amount").val()) || 0;
//         const breakdownTotal = getBreakdownTotal($card);
//         return Math.abs(revenueAmount - breakdownTotal) < 0.01;
//     }

//     function updateActionButtonState() {
//         if (!$actionBtn.length) return;

//         let allValid = true;
//         $(".revenue-card").each(function () {
//             if (!isCardValid($(this))) {
//                 allValid = false;
//                 return false;
//             }
//         });

//         setActionBtnDisabled(!allValid);
//     }

//     function normalizeCardDenominationInputs($card) {
//         $card.find(".denomination-input").each(function () {
//             $(this).val(fmtInt($(this).val()));
//         });
//     }

//     function initCard($card) {
//         toggleCashBreakdown($card);
//         normalizeCardDenominationInputs($card);
//         calculateDenominationTotals($card);
//         updateActionButtonState();
//     }

//     // UI: collapse/expand breakdown
//     $(document).on("click", ".cash-breakdown-header", function () {
//         const $content = $(this).siblings(".cash-breakdown-content");
//         const $toggle = $(this).find(".cash-breakdown-toggle");
//         $content.toggleClass("expanded");
//         $toggle.toggleClass("expanded");
//     });

//     // payment method changes
//     $(document).on("change", ".payment-method-select", function () {
//         const $card = $(this).closest(".revenue-card");
//         toggleCashBreakdown($card);
//         calculateDenominationTotals($card);
//         updateActionButtonState();
//     });

//     // denomination focus/blur/input
//     $(document).on("focus", ".denomination-input", function () {
//         const n = toInt($(this).val());
//         $(this).val(n === 0 ? "" : String(n));
//     });

//     $(document).on("blur", ".denomination-input", function () {
//         $(this).val(fmtInt($(this).val()));
//     });

//     $(document).on("input", ".denomination-input", function () {
//         const raw = cleanIntString($(this).val());
//         const normalized = raw === "" ? "0" : raw.replace(/^0+(?=\d)/, "");
//         $(this).val(fmtInt(normalized));

//         const $card = $(this).closest(".revenue-card");
//         calculateDenominationTotals($card);
//         updateActionButtonState();
//     });

//     // revenue amount input
//     $(document).on("input", ".revenue-amount", function () {
//         const $card = $(this).closest(".revenue-card");
//         if ($card.find(".payment-method-select").val() === "cash") {
//             calculateDenominationTotals($card);
//         }
//         updateActionButtonState();
//     });

//     // submit: strip commas -> integers
//     $form.on("submit", function (e) {
//         $(this).find(".denomination-input").each(function () {
//             $(this).val(toInt($(this).val()));
//         });

//         // re-check before submit (esp. update)
//         updateActionButtonState();

//         if ($actionBtn.length && ($actionBtn.prop("disabled") || $actionBtn.attr("aria-disabled") === "true")) {
//             e.preventDefault();
//             e.stopImmediatePropagation();
//             const firstInvalid = $(".revenue-card").filter(function () {
//                 return !isCardValid($(this));
//             }).first();

//             if (firstInvalid.length) {
//                 firstInvalid[0].scrollIntoView({ behavior: "smooth", block: "center" });
//             }
//             return false;
//         }
//     });

//     /**
//      * Create-mode extras (add/remove/renumber)
//      */
//     function updateRevenueNumbers() {
//         if (!isCreateMode) return;

//         $(".revenue-card").each(function (index) {
//             const $card = $(this);
//             $card.attr("id", "revenue-" + index);
//             $card.attr("data-index", index);
//             $card.find(".revenue-number").text(index + 1);
//             $card.find(".revenue-title").text("Revenue #" + (index + 1));
//             $card.find(".remove-revenue").data("id", index);

//             // only renaming array inputs (create page)
//             $card.find('input[name*="[name]"]').attr("name", "revenues[" + index + "][name]");
//             $card.find('select[name*="[types]"]').attr("name", "revenues[" + index + "][types]");
//             $card.find('select[name*="[payment_method]"]').attr("name", "revenues[" + index + "][payment_method]");
//             $card.find('input[name*="[amount]"]').attr("name", "revenues[" + index + "][amount]");

//             $card.find('input[name*="[bill_1000]"]').attr("name", "revenues[" + index + "][bill_1000]");
//             $card.find('input[name*="[bill_500]"]').attr("name", "revenues[" + index + "][bill_500]");
//             $card.find('input[name*="[bill_200]"]').attr("name", "revenues[" + index + "][bill_200]");
//             $card.find('input[name*="[bill_100]"]').attr("name", "revenues[" + index + "][bill_100]");
//             $card.find('input[name*="[bill_50]"]').attr("name", "revenues[" + index + "][bill_50]");
//             $card.find('input[name*="[bill_20]"]').attr("name", "revenues[" + index + "][bill_20]");

//             $card.find('input[name*="[coin_20]"]').attr("name", "revenues[" + index + "][coin_20]");
//             $card.find('input[name*="[coin_10]"]').attr("name", "revenues[" + index + "][coin_10]");
//             $card.find('input[name*="[coin_5]"]').attr("name", "revenues[" + index + "][coin_5]");
//             $card.find('input[name*="[coin_1]"]').attr("name", "revenues[" + index + "][coin_1]");

//             $card.find('input[name*="[centimo_25]"]').attr("name", "revenues[" + index + "][centimo_25]");
//             $card.find('input[name*="[centimo_10]"]').attr("name", "revenues[" + index + "][centimo_10]");
//             $card.find('input[name*="[centimo_5]"]').attr("name", "revenues[" + index + "][centimo_5]");
//             $card.find('input[name*="[centimo_1]"]').attr("name", "revenues[" + index + "][centimo_1]");
//         });
//     }

//     // remove card (create only)
//     $(document).on("click", ".remove-revenue", function () {
//         if (!isCreateMode) return;

//         const id = $(this).data("id");
//         if (id === 0 || id === "0") {
//             alert("You must have at least one revenue entry.");
//             return;
//         }

//         const $cardToRemove = $("#revenue-" + id);
//         $cardToRemove.animate(
//             { opacity: 0, height: 0, marginBottom: 0, paddingTop: 0, paddingBottom: 0 },
//             300,
//             function () {
//                 $cardToRemove.remove();
//                 updateRevenueNumbers();
//                 updateActionButtonState();
//             }
//         );
//     });

//     // optional keyboard shortcuts only on create page
//     $(document).on("keydown", function (e) {
//         if (!isCreateMode) return;
//         if (!e.ctrlKey || !e.shiftKey) return;

//         if (e.key === "+" || e.key === "=") {
//             e.preventDefault();
//             $("#add-revenue").trigger("click");
//         }
//         if (e.key === "-" || e.key === "_") {
//             e.preventDefault();
//             const $cards = $(".revenue-card");
//             if ($cards.length > 1) $cards.last().find(".remove-revenue").trigger("click");
//         }
//     });

//     // init all existing cards (create + edit)
//     $(".revenue-card").each(function () {
//         initCard($(this));
//     });

//     updateActionButtonState();
// });
