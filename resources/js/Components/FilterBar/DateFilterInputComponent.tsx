import DateInput from '@/Components/Form/DateInput';

export default function DateFilterInput({ name, value, onChange }) {
  return (
    <DateInput
      name={name}
      value={value}
      onChange={onChange}
    />
  );
}