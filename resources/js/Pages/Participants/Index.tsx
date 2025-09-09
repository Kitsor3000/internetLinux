import { Link, usePage } from '@inertiajs/react';
import MainLayout from '@/Layouts/MainLayout';
import Pagination from '@/Components/Pagination/Pagination';
import FilterBar, { FilterBarField } from '@/Components/FilterBar/FilterBar';
import { Participant, PaginatedData } from '@/types';
import Table from '@/Components/Table/Table';
import { useLaravelReactI18n } from 'laravel-react-i18n';
import { useState } from 'react';
import DateFilterInputComponent from '@/Components/FilterBar/DateFilterInputComponent';

const Index = () => {
  const { t } = useLaravelReactI18n();

  const { participants } = usePage<{
    participants: PaginatedData<Participant>;
  }>().props;

  const {
    data,
    meta: { links }
  } = participants;

  const [filters, setFilters] = useState({
    name: '',
    phone: '',
    telegram_username: '',
    joined_date: null as Date | null,
  });

  const handleFilterChange = (field: string, value: string | number | Date | null) => {
    setFilters(prev => ({ ...prev, [field]: value }));
  };

  const filterFields: FilterBarField[] = [
    {
      name: 'name',
      label: t('participants.name'),
      type: 'text',
      value: filters.name,
      onChange: (val) => handleFilterChange('name', val),
      placeholder: t('participants.name_filter_placeholder'),
    },
    {
      name: 'phone',
      label: t('participants.phone'),
      type: 'text',
      value: filters.phone,
      onChange: (val) => handleFilterChange('phone', val),
      placeholder: t('participants.phone_filter_placeholder'),
    },
    {
      name: 'telegram_username',
      label: t('participants.telegram'),
      type: 'text',
      value: filters.telegram_username,
      onChange: (val) => handleFilterChange('telegram_username', val),
      placeholder: t('participants.telegram_filter_placeholder'),
    },
    {
      name: 'joined_date',
      label: t('participants.joined_date'),
      type: 'date',
      value: filters.joined_date,
      onChange: (val) => handleFilterChange('joined_date', val),
      inputComponent: DateFilterInputComponent,
    },
  ];

  const handleSubmit = () => {
  };

  return (
    <div>
      <h1 className="mb-8 text-3xl font-bold">{t('participants.title')}</h1>
      <div className="flex items-center justify-between mb-6">
        <Link
          className="btn-indigo focus:outline-none"
          href={route('participants.create')}
        >
          <span>{t('participants.create')}</span>
        </Link>
      </div>
      <FilterBar filters={filterFields} onSubmit={handleSubmit} />
      <Table
        columns={[
          { label: t('participants.identifier'), name: 'id' },
          { label: t('participants.name'), name: 'name' },
          { label: t('participants.phone'), name: 'phone' },
          { label: t('participants.balance'), name: 'balance' },
          { label: t('participants.telegram'), name: 'telegram_username' },
          { label: t('participants.joined_date'), name: 'joined_date', renderCell: row => row.joined_date ? new Date(row.joined_date).toLocaleDateString('uk-UA') : '' },
        ]}
        rows={data}
        getRowDetailsUrl={row => route('participants.edit', row.id)}
      />
      <Pagination links={links} />
    </div>
  );
};

Index.layout = (page: React.ReactNode) => (
  <MainLayout title='participants.index' children={page} />
);

export default Index;
