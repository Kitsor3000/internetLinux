import { Link, usePage } from '@inertiajs/react';
import MainLayout from '@/Layouts/MainLayout';
import Pagination from '@/Components/Pagination/Pagination';
import Table from '@/Components/Table/Table';
import { useLaravelReactI18n } from 'laravel-react-i18n';
import FilterBar from "@/Components/FilterBar/FilterBar";

type GamePeriod = {
    id: number;
    start_date: string;
    end_date: string;
    duration_weeks: number;
    status: string;
};

type PaginatedData<T> = {
    data: T[];
    meta: { links: any[] };
};

export default function Index() {
    const { t } = useLaravelReactI18n();
    const { gamePeriods } = usePage<{ gamePeriods: PaginatedData<GamePeriod> }>().props;

    return (
      <div>
        <h1 className="mb-8 text-3xl font-bold">{t('game_period.title')}</h1>
        <div className="flex items-center justify-between mb-6">
          <Link
            className="btn-indigo focus:outline-none"
            href={route('game_periods.create')}
          >
            <span>{t('game_period.create')}</span>
          </Link>
        </div>
        {/*<FilterBar filters={filterFields} onSubmit={handleSubmit} />*/}
        <Table
          columns={[
            { label: t('game_period.identifier'), name: 'id' },
            { label: t('game_period.start_date'), name: 'start_date',  renderCell: row => row.start_date ? new Date(row.start_date).toLocaleDateString('uk-UA') : '' },
            { label: t('game_period.end_date'), name: 'end_date', renderCell: row => row.end_date ? new Date(row.end_date).toLocaleDateString('uk-UA') : ''   },
            { label: t('game_period.duration_weeks'), name: 'duration_weeks',  },
            { label: t('game_period.status'), name: 'status', renderCell: row => t('game_period.status_type.' + (row.status)) },
          ]}
          rows={gamePeriods.data}
          getRowDetailsUrl={row => route('game_periods.edit', row.id)}
        />
        <Pagination links={gamePeriods.meta.links} />
      </div>
    );
}

Index.layout = (page: React.ReactNode) => <MainLayout children={page} />;
