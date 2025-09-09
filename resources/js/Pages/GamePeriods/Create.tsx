import { Link, useForm, router } from '@inertiajs/react';
import MainLayout from '@/Layouts/MainLayout';
import LoadingButton from '@/Components/Button/LoadingButton';
import FieldGroup from '@/Components/Form/FieldGroup';
import DateInput from '@/Components/Form/DateInput';
import TextInput from '@/Components/Form/TextInput';
import { useLaravelReactI18n } from 'laravel-react-i18n';
import {useEffect} from "react";
import SelectInput from "@/Components/Form/SelectInput";

export default function Create() {
    const { t } = useLaravelReactI18n();

    const { data, setData, errors, post, processing } = useForm({
        start_date: '',
        end_date: '',
        duration_weeks: '',
    });

    function handleSubmit(e: React.FormEvent<HTMLFormElement>) {
        e.preventDefault();
        post(route('game_periods.store'), {
            onSuccess: () => router.visit(route('game_periods.index')),
        });
    }

    const isMonday = (date: Date) => {
      const day = date.getDay();
      return day === 1;
    }

    const isSunday = (date: Date) => {
      const day = date.getDay();
      return day === 0;
    }

    useEffect(() => {
      if (data.start_date && data.end_date) {
        const start = new Date(data.start_date);
        const end = new Date(data.end_date);

        if (!isNaN(start) && !isNaN(end) && end > start) {
          const msPerWeek = 1000 * 60 * 60 * 24 * 7;
          const weeks = Math.ceil((end - start) / msPerWeek);
          setData('duration_weeks', weeks.toString());
        } else {
          setData('duration_weeks', '');
        }
      }
    }, [data.start_date, data.end_date]);


  return (
        <div>
            <h1 className="mb-8 text-3xl font-bold">
                <Link href={route('game_periods.index')} className="text-indigo-600 hover:text-indigo-700">
                    {t('game_period.title')}
                </Link>
                <span className="font-medium text-indigo-600"> /</span> {t('game_period.create')}
            </h1>
            <div className="overflow-hidden bg-white rounded shadow">
                <form onSubmit={handleSubmit}>
                    <div className="grid gap-8 p-8 lg:grid-cols-3">
                        <FieldGroup label={t('game_period.start_date')} name="start_date" error={errors.start_date}>
                            <DateInput
                                name="start_date"
                                value={data.start_date}
                                onChange={date => setData('start_date', date)}
                                error={errors.start_date}
                                filterDate={isMonday}
                            />
                        </FieldGroup>
                        <FieldGroup label={t('game_period.end_date')} name="end_date" error={errors.end_date}>
                            <DateInput
                                name="end_date"
                                value={data.end_date}
                                onChange={date => setData('end_date', date)}
                                error={errors.end_date}
                                filterDate={isSunday}
                                minDate={data.start_date}
                            />
                        </FieldGroup>
                        <FieldGroup label={t('game_period.duration_week')} name="duration_weeks" error={errors.duration_weeks}>
                            <TextInput
                                name="duration_weeks"
                                type="number"
                                value={data.duration_weeks}
                                onChange={e => setData('duration_weeks', e.target.value)}
                                error={errors.duration_weeks}
                                readOnly={true}
                            />
                        </FieldGroup>
                    </div>
                    <div className="flex items-center justify-end px-8 py-4 bg-gray-100 border-t border-gray-200">
                        <LoadingButton loading={processing} type="submit" className="btn-indigo">
                            {t('game_period.create')}
                        </LoadingButton>
                    </div>
                </form>
            </div>
        </div>
    );
}

Create.layout = (page: React.ReactNode) => (
    <MainLayout title='game_period.create' children={page} />
);
