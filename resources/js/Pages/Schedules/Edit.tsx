import {useForm, Link, usePage, Head, router} from '@inertiajs/react';
import MainLayout from '@/Layouts/MainLayout';
import TextInput from '@/Components/Form/TextInput';
import SelectInput from '@/Components/Form/SelectInput';
import { useLaravelReactI18n } from 'laravel-react-i18n';
import {dayOfWeekList, dayOfWeekOptionsList, typeOptionsList} from "@/utils";
import FieldGroup from "@/Components/Form/FieldGroup";
import LoadingButton from "@/Components/Button/LoadingButton";
import React from "react";
import DeleteButton from "@/Components/Button/DeleteButton";

type GamePeriod = {
    id: number;
    start_date: string;
    end_date: string;
};

type Schedule = {
    id: number;
    period_id: number;
    day: string;
    start_time: string;
    end_time: string;
    type: string;
};

function Edit() {
    const { t } = useLaravelReactI18n();
    const { schedule, gamePeriod } = usePage<{ schedule: Schedule, gamePeriod: GamePeriod }>().props;

    const { data, setData, put, processing, errors } = useForm({
        period_id: schedule.period_id || '',
        day: schedule.day || '',
        start_time: schedule.start_time || '',
        end_time: schedule.end_time || '',
        type: schedule.type || '',
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        put(route('schedules.update', { schedule: schedule.id, gamePeriod: gamePeriod.id }));
    };

    function destroy() {
      if (confirm('schedules.remove_confirmation_message')) {
        router.delete(route('schedules.destroy', {gamePeriod: gamePeriod.id, schedule: schedule.id}));
      }
    }

    return (
        <div>
          <Head title={t('schedules.edit')}/>
          <h1 className="text-xl font-bold">
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
              <Link
                href={route('schedules.index', {gamePeriod: gamePeriod.id})}
                className="text-indigo-600 hover:text-indigo-700"
              >
                {t('schedules.index')}
              </Link>
              <span className="font-medium text-indigo-600"> / </span>
              <span className="font-medium">{t('common.day_of_week.' + schedule.day)} {t('schedules.types.' + schedule.type)}, {schedule.start_time} - {schedule.end_time}</span>
            </div>
          </h1>
          <form onSubmit={handleSubmit} className="max-w-2xl space-y-5">
            <FieldGroup
              label={t('schedules.day')}
              name="day"
              error={errors.day}
            >
              <SelectInput

                value={data.day}
                onChange={(e) =>{
                  setData('day', e.target.value)
                }}
                error={errors.day}
                options={dayOfWeekOptionsList()}
                renderLabel={(label)=> t('common.day_of_week.' + label)}
                required
              />
            </FieldGroup>
            <FieldGroup
              label={t('schedules.start_time')}
              name="start_time"
              error={errors.start_time}
            >
              <TextInput
                type="time"
                value={data.start_time}
                onChange={e => setData('start_time', e.target.value)}
                error={errors.start_time}
                required
              />
            </FieldGroup>
            <FieldGroup
              label={t('schedules.end_time')}
              name='end_time'
              error={errors.end_time}
            >
              <TextInput
                type="time"
                value={data.end_time}
                onChange={e => setData('end_time', e.target.value)}
                error={errors.end_time}
                required
              />
            </FieldGroup>
            <FieldGroup
              name='type'
              label={t('schedules.type')}
            >
              <SelectInput
                value={data.type}
                onChange={e => setData('type', e.target.value)}
                error={errors.type}
                renderLabel={(label)=> t('common.training_type.' + label) }
                options={typeOptionsList()}
                required
              >

              </SelectInput>
            </FieldGroup>
            <div className="flex items-center justify-end">
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
    );
}

Edit.layout = (page: React.ReactNode) => <MainLayout title="schedule.edit" children={page} />;

export default Edit;
