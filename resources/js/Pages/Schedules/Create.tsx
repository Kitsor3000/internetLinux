import { useState } from 'react';
import { useForm, Link, usePage } from '@inertiajs/react';
import MainLayout from '@/Layouts/MainLayout';
import TextInput from '@/Components/Form/TextInput';
import SelectInput from '@/Components/Form/SelectInput';
import { useLaravelReactI18n } from 'laravel-react-i18n';
import {dayOfWeek, dayOfWeekOptionsList, scheduleType, typeOptionsList} from "@/utils";
import FieldGroup from "@/Components/Form/FieldGroup";

type GamePeriod = {
    id: number;
    start_date: string;
    end_date: string;
};

function Create() {
    const { t } = useLaravelReactI18n();
    const { gamePeriod } = usePage<{ gamePeriod: GamePeriod }>().props;

    const { data, setData, post, processing, errors, reset } = useForm({
        period_id: gamePeriod.id,
        day: dayOfWeek(0),
        start_time: '',
        end_time: '',
        type: scheduleType(0),
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        post(route('schedules.store', {gamePeriod: gamePeriod.id}));
    };

    return (
        <div>
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
          </div>
          <div className="mb-8 flex items-center justify-between">
              <Link href={route('schedules.index', { gamePeriod: gamePeriod.id })} className="btn btn-secondary">
                  {t('common.back')}
              </Link>
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
                error={errors.day}
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
                <button type="submit" className="btn btn-indigo" disabled={processing}>
                    {t('common.save')}
                </button>
            </form>
        </div>
    );
}

Create.layout = (page: React.ReactNode) => <MainLayout title="schedule.create" children={page} />;

export default Create;
