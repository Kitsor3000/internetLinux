import React from 'react';
import {Head, Link} from '@inertiajs/react';
import {scheduleType} from "@/utils";
import Table from "@/Components/Table/Table";
import {useLaravelReactI18n} from "laravel-react-i18n";
import MainLayout from "@/Layouts/MainLayout";

type Participant = {
    id: number;
    name: string;
    // додайте інші властивості учасника, якщо потрібно
};

type Schedule = {
    id: number;
    day: number;
    start_time: string;
    end_time: string;
    // додайте інші властивості розкладу, якщо потрібно
};

type Booking = {
    id: number;
    participant: Participant;
    schedule_id: number;
    fixed_price: number;
    dayname: string;
    time: string;
    schedule: Schedule | null;
};

type BookingCollection = {
    [scheduleId: number]: Booking[];
};

type GamePeriod = {
    id: number;
    start_date: string;
    end_date: string;
    duration_weeks: number;
    status: string;
    // додайте інші властивості періоду гри, якщо потрібно
};

interface Props {
    gamePeriod: GamePeriod;
    bookings: BookingCollection;
}

const Index: React.FC<Props> = ({ gamePeriod, bookings }) => {

  const { t } = useLaravelReactI18n();

  return (
    <div className="p-6">
      <div className="flex items-center justify-between mb-6">
        <Link
          href={route('game_periods.index')}
          className="text-indigo-600 hover:text-indigo-700"
        >
          {t('game_period.index')}
        </Link>
        <span className="font-medium text-indigo-600"> / </span>
        <Link
          href={route('game_periods.edit', {gamePeriod: gamePeriod.id})}
          className="text-indigo-600 hover:text-indigo-700"
        >
          {t('game_period.game_period')} {gamePeriod.start_date} - {gamePeriod.end_date}
        </Link>
        <span className="font-medium text-indigo-600"> / </span>
      </div>

        <Head title="Бронювання" />

        <h1 className="text-2xl font-bold mb-4">
            Бронювання на період: {gamePeriod.start_date} — {gamePeriod.end_date}
        </h1>

      <div className="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
        <Table
          columns={[
            { label: t('booking.participant'), name: 'participant', renderCell: (row) => row.participant.name + ' ' + row.participant.telegram_username },
            { label: t('booking.day'), name: 'day', renderCell: (row) => t('common.day_of_week.' + row.schedule.day)},
            { label: t('booking.time'), name: 'time'},
            {
              label: t('booking.type'),
              name: 'type',
              renderCell: row => row?.schedule?.type ? t('schedules.type.' + scheduleType(row.schedule.type)) :'',
            },
          ]}
          rows={bookings}
        />
      </div>
    </div>
)};

Index.layout = (page: React.ReactNode) => <MainLayout title='shedule.index' children={page} />;

export default Index;
