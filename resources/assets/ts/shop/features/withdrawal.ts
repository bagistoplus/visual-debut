import type { Alpine as AlpineType } from 'alpinejs';

interface ReceiptProps {
  copied: string;
}

/**
 * Puts text on the clipboard. The Clipboard API needs a secure context,
 * which a store served over plain http is not.
 */
const writeClipboard = async (text: string) => {
  if (navigator.clipboard && window.isSecureContext) {
    await navigator.clipboard.writeText(text);

    return;
  }

  const field = document.createElement('textarea');

  field.value = text;
  field.style.position = 'fixed';
  field.style.opacity = '0';
  document.body.append(field);
  field.select();
  document.execCommand('copy');
  field.remove();
};

/**
 * Prints the receipt on its own. Hiding the rest of the page with print CSS
 * alone still leaves its height behind as blank pages, so a copy of the
 * receipt goes to the top of the body and every other child of the body is
 * left out of the print until the dialog closes.
 */
const printAlone = (receipt: HTMLElement) => {
  const copy = receipt.cloneNode(true) as HTMLElement;
  const others = Array.from(document.body.children);

  copy.classList.add('withdrawal-print-copy');
  copy.setAttribute('x-ignore', '');
  others.forEach((element) => element.classList.add('withdrawal-print-hidden'));
  document.body.append(copy);

  window.addEventListener(
    'afterprint',
    () => {
      copy.remove();
      others.forEach((element) => element.classList.remove('withdrawal-print-hidden'));
    },
    { once: true }
  );

  window.print();
};

export default function (Alpine: AlpineType) {
  /**
   * The EU withdrawal receipt: the customer's proof of the declaration,
   * which they keep by copying its reference or printing it.
   */
  Alpine.data('VisualWithdrawalReceipt', (props: ReceiptProps) => ({
    async copy(reference: string) {
      try {
        await writeClipboard(reference);
        this.$toaster.success(props.copied);
      } catch (error) {
        console.error(error);
      }
    },

    print() {
      printAlone(this.$refs.receipt);
    },
  }));
}
