import React from 'react';
import { Head } from '@inertiajs/react';
import { Link, usePage, useForm, router } from '@inertiajs/react';
import MainLayout from '@/Layouts/MainLayout';
import LoadingButton from '@/Components/Button/LoadingButton';
import TextInput from '@/Components/Form/TextInput';
import { Participant } from '@/types';
import FieldGroup from '@/Components/Form/FieldGroup';
import DateInput from "@/Components/Form/DateInput";
import { useLaravelReactI18n } from 'laravel-react-i18n';
import {CheckboxInput} from "@/Components/Form/CheckboxInput";
import DeleteButton from "@/Components/Button/DeleteButton";

const Edit = () => {
  const {t} = useLaravelReactI18n();
  const { participant } = usePage<{
    participant: Participant;
  }>().props;

  const { data, setData, errors, put, processing } = useForm<Participant>({
    id: participant.id,
    name: participant.name || '',
    phone: participant.phone || '',
    balance: participant.balance || '0',
    telegram_username: participant.telegram_username || '',
    joined_date: participant.joined_date || '',
    telegram_id: participant.telegram_id || '',
    telegram_allowed: participant.telegram_allowed,
    telegram_usage: !!participant.telegram_id,
  });

  function handleSubmit(e: React.FormEvent<HTMLFormElement>) {
    e.preventDefault();
    put(route('participants.update', participant.id));
  }

  function destroy() {
    if (confirm('participants.remove_confirmation_message')) {
      router.delete(route('participants.destroy', participant.id));
    }
  }

  function restore() {
    if (confirm('Are you sure you want to restore this participant?')) {
      router.put(route('participants.restore', participant.id));
    }
  }

  return (
    <div>
      <Head title={`${participant.name}`} />
      <h1 className="mb-8 text-3xl font-bold">
        <Link
          href={route('participants.index')}
          className="text-indigo-600 hover:text-indigo-700"
        >
          {t('participants.title')}
        </Link>
        <span className="mx-2 font-medium text-indigo-600">/</span>
        {participant.name}
      </h1>
      <div className="overflow-hidden bg-white rounded shadow">
        <form onSubmit={handleSubmit}>
          <div className="grid gap-8 p-8 lg:grid-cols-3">
            <FieldGroup
              label={t('participants.name')}
              name="name"
              error={errors.name}
            >
              <TextInput
                name="name"
                error={errors.name}
                value={data.name}
                onChange={e => setData('name', e.target.value)}
              />
            </FieldGroup>

            <FieldGroup
              label={t('participants.phone')}
              name="phone"
              error={errors.phone}
            >
              <TextInput
                name="phone"
                error={errors.phone}
                value={data.phone}
                onChange={e => setData('phone', e.target.value)}
              />
            </FieldGroup>

            <FieldGroup
              label={t('participants.telegram_username')}
              name="telegram_username"
              error={errors.telegram_username}
            >
              <TextInput
                name="telegram_username"
                type="text"
                error={errors.telegram_username}
                value={data.telegram_username}
                onChange={e => setData('telegram_username', e.target.value)}
              />
            </FieldGroup>
            <FieldGroup
              label={t('participants.balance')}
              name="balance"
            >
              <TextInput
                name="balance"
                type="text"
                readOnly={true}
                disabled={true}
                error={errors.telegram_username}
                value={data.balance}
              />
            </FieldGroup>
            <FieldGroup
              label={t('participants.joined_date')}
              name="joined_date"
              error={errors.joined_date}
            >
              <DateInput
                name="joined_date"
                value={data.joined_date}
                onChange={date => setData('joined_date',  date)}
                error={errors.joined_date}
              />
            </FieldGroup>
            <FieldGroup
              label={t('participants.telegram_allowed')}
              name="telegram_allowed"
              error={errors.telegram_allowed}
            >
              <CheckboxInput
                name="telagram_allowed"
                value={data.telegram_allowed}
                onChange={value => {
                  setData('telegram_allowed', value);
                }}
              />
            </FieldGroup>

            <FieldGroup
              label={t('participants.telegram_usage')}
              name="telegram_usage"
              error={errors.telegram_usage}
            >
              <CheckboxInput
                name="telagram_usage"
                value={data.telegram_usage}
                disabled={true}
                readOnly={true}

              />
            </FieldGroup>

          </div>
          <div className="flex items-center px-8 py-4 bg-gray-100 border-t border-gray-200">
            <DeleteButton onDelete={destroy}>{t('remove.confirmation_button')}</DeleteButton>
            <LoadingButton
              loading={processing}
              type="submit"
              className="ml-auto btn-indigo"
            >
              {t('common.update')}
            </LoadingButton>
          </div>
        </form>
      </div>
    </div>
  );
};

/**
 * Persistent Layout (Inertia.js)
 *
 * [Learn more](https://inertiajs.com/pages#persistent-layouts)
 */
Edit.layout = (page: React.ReactNode) => <MainLayout children={page} />;

export default Edit;
