import { ComponentProps } from 'react';

interface SelectInputProps extends ComponentProps<'select'> {
  error?: string;
  options: { value: string; label: string }[];
  renderLabel?: (label: string) => string;
}

export default function SelectInput({
  name,
  error,
  className,
  options = [],
  renderLabel = (label: string):string => label,
  ...props
}: SelectInputProps) {
  return (
    <select
      id={name}
      name={name}
      {...props}
      className={`form-select w-full focus:outline-none focus:ring-1 focus:ring-indigo-400 focus:border-indigo-400 border-gray-300 rounded ${
        error ? 'border-red-400 focus:border-red-400 focus:ring-red-400' : ''
      }`}
    >
      {options?.map(({ value, label }, index) => (
        <option key={index} value={value}>
          {renderLabel(label)}
        </option>
      ))}
    </select>
  );
}
