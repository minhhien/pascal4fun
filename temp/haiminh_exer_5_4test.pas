program TestProgram;

function cal(x:integer): string;
begin
	If x div 2 = 0 then cal:= 'chan' else cal:='le';
end;					

begin
	writeln(cal(#NUM));
end.