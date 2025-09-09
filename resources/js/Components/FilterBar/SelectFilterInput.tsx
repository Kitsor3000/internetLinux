import SelectInput from '@/Components/Form/SelectInput';

export default function SelectFilterInput({ name, value, onChange, options }) {
  return (
    <SelectInput
      name={name}
      value={value}
      onChange={e => onChange(e.target.value)}
      options={options}
    />
  );
}