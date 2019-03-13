# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, -3.76, 10.55, 20.93, -18.67, 65.89, 24.50, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, -48.11, 27.48, 12.04, 22.00, 45.08, 31.96, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, -17.29, 33.45, 48.31, -3.79, 40.55, -5.48, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_ani')
