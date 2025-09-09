import MainMenuItem from '@/Components/Menu/MainMenuItem';
import {CalendarCheck2Icon, CircleGauge, CoinsIcon, UsersRoundIcon} from 'lucide-react';
import {useLaravelReactI18n} from "laravel-react-i18n";

interface MainMenuProps {
  className?: string;
}

export default function MainMenu({ className }: MainMenuProps) {
  const {t} = useLaravelReactI18n();
  return (
    <div className={className}>
      <MainMenuItem
        text={t('participants.title')}
        link="participants.index"
        icon={<UsersRoundIcon size={20} />}
      />
      <MainMenuItem
        text={t('game_period.title')}
        link="game_periods.index"
        icon={<CalendarCheck2Icon size={20} />}
      />
      <MainMenuItem
        text="Invoices"
        link="game_periods.index"
        icon={<CoinsIcon size={20} />}
      />
    </div>
  );
}
