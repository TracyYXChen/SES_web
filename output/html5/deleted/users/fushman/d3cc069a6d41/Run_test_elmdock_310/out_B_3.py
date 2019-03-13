# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, -26.51, 7.92, 17.75, -49.36, 4.37, -16.36, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, -33.17, 25.64, -4.97, -43.00, -12.98, 5.63, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, -21.97, -0.78, -9.72, -56.82, 14.08, 12.08, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_B_3')
