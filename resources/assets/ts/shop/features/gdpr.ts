import type { Alpine as AlpineType } from 'alpinejs';

interface Column {
  index: string;
  visibility: boolean;
}

interface GdprRow {
  id: number | string;
  status: string;
}

interface ListProps {
  revokeUrl: string;
  revokeMethod: 'GET' | 'POST';
  csrfToken: string;
  labels: {
    revoke: string;
  };
}

interface ListScope {
  available: { records: GdprRow[] };
  $triggerConfirm(options: { onConfirm: () => void }): void;
}

const isPending = (record: GdprRow) => String(record.status).includes('label-pending');

const submit = (url: string, method: ListProps['revokeMethod'], csrfToken: string) => {
  const form = document.createElement('form');

  form.method = method;
  form.action = url;

  if (method === 'POST') {
    const token = document.createElement('input');

    token.type = 'hidden';
    token.name = '_token';
    token.value = csrfToken;
    form.append(token);
  }

  document.body.append(form);
  form.submit();
};

export default function (Alpine: AlpineType) {
  /**
   * The GDPR requests list. Bagisto sends revoke as a column of raw buttons,
   * disabled on every row but the pending ones, so that column is replaced by
   * a Revoke action on pending rows. It asks first, then submits a real form:
   * Bagisto's revoke only ever redirects with a flash message, and is a GET
   * link up to 2.3.9 and a POST form from 2.3.10.
   */
  Alpine.data('VisualGdprList', (props: ListProps) => ({
    columnVisible(column: Column) {
      return column.visibility && column.index !== 'revoke';
    },

    hasRowActions(this: ListScope) {
      return this.available.records.some(isPending);
    },

    rowActions(record: GdprRow) {
      if (!isPending(record)) {
        return [];
      }

      return [
        {
          title: props.labels.revoke,
          method: props.revokeMethod,
          url: props.revokeUrl.replace('__id__', String(record.id)),
        },
      ];
    },

    handleAction(this: ListScope, action: { url: string; method: ListProps['revokeMethod'] }) {
      this.$triggerConfirm({
        onConfirm: () => submit(action.url, action.method, props.csrfToken),
      });
    },
  }));
}
