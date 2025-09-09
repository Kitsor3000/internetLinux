import { Link, useForm, router } from '@inertiajs/react';
import { useLaravelReactI18n } from 'laravel-react-i18n'; // Додано для i18n
import MainLayout from '@/Layouts/MainLayout';
import LoadingButton from '@/Components/Button/LoadingButton';
import TextInput from '@/Components/Form/TextInput';
import FieldGroup from '@/Components/Form/FieldGroup';
import DateInput from '@/Components/Form/DateInput';
import { Participant } from '@/types';
import {CheckboxInput} from "@/Components/Form/CheckboxInput";

const Create = () => {
  const { t } = useLaravelReactI18n();

  const { data, setData, errors, post, processing } = useForm<Participant>({
    id: null,
    name: '',
    phone: '',
    telegram_username: '',
    joined_date: new Date(),
    telegram_allowed: false,
    telegram_usage: false,
    telegram_id: '',
  });

  function handleSubmit(e: React.FormEvent<HTMLFormElement>) {
    e.preventDefault();
    post(route('participants.store'), {
      onSuccess: () => {
        router.visit(route('participants.index'));
      },
    });
  }

  return (
    <div>
      <h1 className="mb-8 text-3xl font-bold">
        <Link
          href={route('participants.index')}
          className="text-indigo-600 hover:text-indigo-700"
        >
          {t('Participants')}
        </Link>
        <span className="font-medium text-indigo-600"> /</span>
        {t('common.create')}
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
                error={errors.telegram_username}
                value={data.telegram_username}
                onChange={e => setData('telegram_username', e.target.value)}
              />
            </FieldGroup>
            <FieldGroup label={t('participants.joined_date')} name="joined_date" error={errors.joined_date}>
              <DateInput
                name="joined_date"
                value={data.joined_date}
                onChange={date => setData('joined_date',  date)}
                error={errors.joined_date}
              />
            </FieldGroup>
            <FieldGroup label={t('participants.telegram_allowed')} name="telegram_allowed" error={errors.telegram_allowed}>
              <CheckboxInput
                name='telegram_allowed'
                value={data.telegram_allowed}
                onChange={(value) => setData('telegram_allowed', value)}
              >
              </CheckboxInput>
            </FieldGroup>
          </div>
          <div className="flex items-center justify-end px-8 py-4 bg-gray-100 border-t border-gray-200">
            <LoadingButton
              loading={processing}
              type="submit"
              className="btn-indigo"
            >
              {t('common.create')}
            </LoadingButton>
          </div>
        </form>
      </div>
    </div>
  );
};

Create.layout = (page: React.ReactNode) => (
  <MainLayout title="Create Contact" children={page} />
);

export default Create;
