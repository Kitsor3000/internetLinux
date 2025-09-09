import React from 'react';

export type FilterBarField = {
  name: string;
  label?: string;
  type: 'text' | 'select' | 'date';
  value: string | number | Date | null;
  onChange: (value: string | number | Date | null) => void;
  options?: { value: string; label: string }[];
  placeholder?: string;
  inputComponent?: React.ComponentType<{
    name?: string;
    value: any;
    onChange: (changedValue:any) => void;
  }>;
};

type FilterBarProps = {
  filters: FilterBarField[];
  onSubmit: () => void;
};

export default function FilterBar({ filters, onSubmit }: FilterBarProps) {
  return (
    <form
      className="flex gap-2 mb-4"
      onSubmit={e => {
        e.preventDefault();
        onSubmit();
      }}
    >
      {filters.map(field => (
        <div key={field.name} className="flex flex-col">
          {field.label && <label className="text-xs mb-1">{field.label}</label>}
          {field.type === 'text' && (
            <input
              type="text"
              name={field.name}
              value={field.value as string | number}
              onChange={e => field.onChange(e.target.value)}
              placeholder={field.placeholder}
              className="form-input w-full border rounded px-2 py-1"
            />
          )}
          {field.type === 'select' && (
            <select
              name={field.name}
              value={field.value as string}
              onChange={e => field.onChange(e.target.value)}
              className="form-select w-full border rounded px-2 py-1"
            >
              {field.options?.map(({ value, label }) => (
                <option key={value} value={value}>{label}</option>
              ))}
            </select>
          )}
          {field.type === 'date' && field.inputComponent && (
            <field.inputComponent
              name={field.name}
              value={field.value as Date | null}
              onChange={field.onChange}
            />
          )}
        </div>
      ))}
      <button type="submit" className="btn btn-indigo h-9 mt-5">Фільтрувати</button>
    </form>
  );
}
